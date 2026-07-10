<?php

class Tools extends Controller {
    private $token = 'MAWARdeploy2024';

    private function verifyToken() {
        $inputToken = isset($_GET['token']) ? trim($_GET['token']) : '';
        if ($inputToken !== $this->token) {
            http_response_code(403);
            echo "Access Denied\n";
            exit;
        }
    }

    public function index() {
        $this->verifyToken();
        echo "Tools Controller Active. Actions: info, deploy\n";
    }

    public function info() {
        $this->verifyToken();
        header('Content-Type: text/plain');
        echo "=== SERVER INFO ===\n";
        echo "DOCUMENT_ROOT: " . $_SERVER['DOCUMENT_ROOT'] . "\n";
        echo "Current Dir: " . __DIR__ . "\n";
        
        $homeDir = dirname(dirname(dirname($_SERVER['DOCUMENT_ROOT'])));
        echo "Home Dir: $homeDir\n\n";

        echo "=== HOME DIRECTORY LISTING ===\n";
        if (is_dir($homeDir)) {
            $files = scandir($homeDir);
            foreach ($files as $f) {
                if ($f === '.' || $f === '..') continue;
                $p = $homeDir . '/' . $f;
                echo $f . " - " . (is_dir($p) ? "DIR" : "FILE") . "\n";
            }
        } else {
            echo "Cannot read home directory\n";
        }

        echo "\n=== SEARCHING SUBDOMAIN DIRECTORY ===\n";
        $possibleDirs = [
            $homeDir . '/laporan.maal.ppmawar.or.id',
            $homeDir . '/laporan.maal.ppmawar.or.id/public_html',
            dirname($_SERVER['DOCUMENT_ROOT']) . '/laporan.maal.ppmawar.or.id',
            $_SERVER['DOCUMENT_ROOT'] . '/laporan_maal',
        ];

        foreach ($possibleDirs as $dir) {
            echo "Checking: $dir → " . (is_dir($dir) ? "EXISTS" : "NOT FOUND") . "\n";
            if (is_dir($dir)) {
                echo "  --- Files in $dir ---\n";
                $files = scandir($dir);
                foreach ($files as $f) {
                    if ($f === '.' || $f === '..') continue;
                    $p = $dir . '/' . $f;
                    echo "  " . $f . " (" . (is_file($p) ? filesize($p) . " bytes" : "DIR") . ") - " . date("Y-m-d H:i:s", filemtime($p)) . "\n";
                }
            }
        }
    }

    public function deploy() {
        $this->verifyToken();
        header('Content-Type: text/plain');
        echo "=== SUBDOMAIN DEPLOYMENT START ===\n";
        
        $homeDir = dirname(dirname(dirname($_SERVER['DOCUMENT_ROOT'])));
        $possibleDirs = [
            $homeDir . '/laporan.maal.ppmawar.or.id',
            $homeDir . '/laporan.maal.ppmawar.or.id/public_html',
            dirname($_SERVER['DOCUMENT_ROOT']) . '/laporan.maal.ppmawar.or.id',
            $_SERVER['DOCUMENT_ROOT'] . '/laporan_maal',
        ];

        $targetDir = null;
        foreach ($possibleDirs as $dir) {
            if (is_dir($dir)) {
                $targetDir = $dir;
                break;
            }
        }

        if (!$targetDir) {
            echo "ERROR: Target directory for subdomain not found!\n";
            exit;
        }

        echo "Target Directory: $targetDir\n\n";

        $githubRawUrl = 'https://raw.githubusercontent.com/it-ppmawar/maal.ppmawar.or.id/main/laporan_maal/';
        $filesToDeploy = ['index.html', 'csv_proxy.php', '.htaccess'];

        $successCount = 0;
        foreach ($filesToDeploy as $file) {
            $url = $githubRawUrl . $file;
            echo "Fetching $file from GitHub... ";
            
            $content = $this->fetchUrl($url);
            if ($content === false || strlen($content) < 5) {
                echo "FAILED (Unable to download or empty)\n";
                continue;
            }
            echo "SUCCESS (" . strlen($content) . " bytes)\n";

            $destPath = $targetDir . '/' . $file;
            echo "Writing to $destPath... ";
            $written = file_put_contents($destPath, $content);
            if ($written !== false) {
                echo "SUCCESS ($written bytes written)\n";
                $successCount++;
            } else {
                echo "FAILED to write\n";
            }
        }

        echo "\nDeployment finished. Successful files: $successCount / " . count($filesToDeploy) . "\n";
    }

    private function fetchUrl($url) {
        if (function_exists('curl_init')) {
            $ch = curl_init();
            curl_setopt_array($ch, [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_USERAGENT => 'Mozilla/5.0',
            ]);
            $data = curl_exec($ch);
            $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            return ($code === 200) ? $data : false;
        }
        
        $ctx = stream_context_create([
            'ssl' => ['verify_peer' => false, 'verify_peer_name' => false],
            'http' => ['timeout' => 30, 'user_agent' => 'Mozilla/5.0']
        ]);
        return @file_get_contents($url, false, $ctx);
    }
}
