<?php
    class Flasher {
        public static function setFlash($message, $action, $type) {
            $_SESSION['flash'] = [
                'message' => $message,
                'action' => $action,
                'type' => $type
            ];
        }

        public static function flash() {
            if(isset($_SESSION['flash'])) {
                echo '<div class="h-8 flex items-center justify-center px-4 py-2 ' . $_SESSION['flash']['type'] . ' rounded-md mb-4" id="flasher">
                <p>Data ' . $_SESSION['flash']['message'] . ' ' . $_SESSION['flash']['action'] . '</p>
                <button onclick="closeNoti()" class="ms-2">
                    <i data-feather="x" class="hover:bg-slate-300 rounded-lg"></i>
                </button>
              </div>';
              
              unset($_SESSION['flash']);
              session_write_close();
            }
        }
    }