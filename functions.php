<?php
# 직접 접근을 막는다요
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) die ('Please do not load this page directly. Thanks!');

# 허접하지만 자존심 상 제 프레임워크를 상속 받아요.
class sjUploagin extends Framework_Sujin_Plugin {
	private static $instance = false;

	protected function __construct() {
		$this->debug = true;
		$this->trigger_hooks();

		$this->text_domain = "uploagin";
		parent::__construct();
	}

	private function trigger_hooks() {
		add_action('init', array(&$this, 'init'));
		# 어드민 메뉴
		add_action('admin_menu', array(&$this, 'trigget_admin_menu'));

		# 유저 인포에 추가
		add_action('show_user_profile', array(&$this, 'edit_user_profile'));
		add_action('edit_user_profile', array(&$this, 'edit_user_profile'));

		# 로그인 폼에 추가
		add_action('login_enqueue_scripts', array(&$this, 'login_enqueue_scripts'), 1);
		add_action('login_form', array(&$this, 'login_form'));
		add_filter('authenticate', array(&$this, 'authenticate'), 10, 3);

		# 스타일
		add_action('admin_enqueue_scripts', array(&$this, 'admin_enqueue_scripts'), 1);
	}

	public function init() {
		# 키 생성
		$user = wp_get_current_user();

		if (is_admin() && isset($_GET["mode"]) && $_GET["mode"] == "create-key" && isset($_GET["user_id"]) && (current_user_can("create_users") || $user->ID == $_GET["user_id"])) {
			require_once("create_key.php");
			die;
		} else if (is_admin() && isset($_GET["mode"]) && $_GET["mode"] == "delete-key" && isset($_GET["user_id"]) && (current_user_can("create_users") || $user->ID == $_GET["user_id"])) {
			delete_user_meta($_GET["user_id"], "sj-uploagin-key");
			$this->redirect();
		}
	}

	public function login_enqueue_scripts() {
		wp_enqueue_script('jquery');
	}

	public function admin_enqueue_scripts() {
		$url = plugin_dir_url(__FILE__);
		wp_enqueue_style("uploagin", $url . 'uploagin.css');
	}

	public function authenticate($user, $username, $password){
		$auth = get_option("sj-uploagin-auth");
		$user = get_user_by('login', $username);
	    $uploagin = $_FILES["uploagin"]["tmp_name"];

		if (!$auth || $auth == "none") {
			@unlink($uploagin);
			return null;
		}

		$key = get_user_meta($user->ID, "sj-uploagin-key", true);

		if (empty($key)) {
			@unlink($uploagin);
			return null;
		}

		if ($user && $auth == "admin" && is_array($user->roles) && !in_array("administrator", $user->roles)) {
			@unlink($uploagin);
			return null;
		}

		if (empty($uploagin)) {
			@unlink($uploagin);

	        remove_action('authenticate', "wp_authenticate_username_password", 20); 
	        return new WP_Error('denied', __("<strong>ERROR</strong>: Your uploagin file was invalid."));
		}

		$im = @imagecreatefrompng($uploagin);

		if (empty($im)) {
			@unlink($uploagin);
			@imagedestroy($im);

	        remove_action('authenticate', "wp_authenticate_username_password", 20); 
	        return new WP_Error('denied', __("<strong>ERROR</strong>: Your uploagin file was invalid."));
		}

		foreach($key as $k) {
			$color = $k["color"];
			$x = $k["x"];
			$y = $k["y"];

			$rgb = imagecolorat($im, $x, $y);
			$b = $rgb & 0xFF;

			if ($color != $b) {
				@unlink($uploagin);
				@imagedestroy($im);
	
		        remove_action('authenticate', "wp_authenticate_username_password", 20); 
		        return new WP_Error('denied', __("<strong>ERROR</strong>: Your uploagin file was invalid."));
			}
		}

		@unlink($uploagin);
		@imagedestroy($im);
	    return null;
	}

	public function login_form() {
		$auth = get_option("sj-uploagin-auth");

		if (!$auth || $auth == "none")
			return true;

		?>
		<p style="margin-bottom:20px;">
			<label for="uploagin"><?php _e('Uploagin') ?><br />
			<input type="file" name="uploagin" id="uploagin" class="" value="" /></label>
		</p>

		<p style="margin-bottom:20px;">
			If you have a problem with login, please check <a href="http://www.sujinc.com/lab/uploag-in/">the official page</a>.
		</p>

		<script>
			jQuery("#loginform").attr("enctype", "multipart/form-data");
		</script>
		<?php
	}

	public function edit_user_profile($user) {
		$url_don = admin_url('options-general.php?page=uploagin-options&mode=create-key&user_id=' . $user->ID);
		$url_del = admin_url('options-general.php?page=uploagin-options&mode=delete-key&user_id=' . $user->ID);

		$key = get_user_meta($user->ID, "sj-uploagin-key", true);
		?>
		<h3>Set and Download Uploagin Key File</h3>
		
		<?php if ($key) { ?>

		<p>This user aleady have a key file</p>
		<a href="<?php echo $url_don ?>">Reset Key File</a>

		<h3>Delete Uploagin Key</h3>
		<a href="<?php echo $url_del ?>">Delete</a>

		<?php } else { ?>

		<a href="<?php echo $url_don ?>">Download</a><br />

		<?php } ?>

		<?php
	}

	# 어드민 메뉴를 만들어요.
	public function trigget_admin_menu() {
		add_options_page(__('Uploagin', $this->text_domain), __('Uploagin', $this->text_domain), 'manage_options', 'uploagin-options', array(&$this, 'admin_menu'));
	}

	public function admin_menu() {
		# 저장
		if (isset($_POST['action'])) {
			update_option("sj-uploagin-auth", $_POST["auth"]);
		}

		require_once("admin_menu.php");
	}

	# 인스턴스를 생성해요
	public static function getInstance() {
		if (!self::$instance)
			self::$instance = new self;

		return self::$instance;
	}
}

$sjUploagin = sjUploagin::getInstance();