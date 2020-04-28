<?php
	/**
	 * Session Handling
	 */
	class Session{
		
		public static function init(){
			session_start();
		}

		public static function set($key, $value){
			$_SESSION[$key] = $value;
		}

		public static function get($key){
			if (isset($_SESSION[$key])){
				return $_SESSION[$key];
			} else {
				return false;
			}
		}

		public static function checkSession(){
			self::init();
			if (self::get("login") == false) {
				self::destroy();
				header("location:login.php");
			}
		}

		public static function checkLogin(){
			self::init();
			if (self::get("login") == true) {
				header("location:index.php");
			}
		}

		public static function destroy(){
			session_destroy();
			echo "<script>window.location = 'login.php';</script>";
		}

	}
?>