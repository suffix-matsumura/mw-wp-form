<?php
/**
 * Name: MW Validation Rule noEmpty
 * Description: 値が空ではない（0は許可）
 * Version: 1.0.0
 * Author: Takashi Kitajima
 * Author URI: http://2inc.org
 * Created : July 21, 2014
 * Modified:
 * License: GPLv2
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
class MW_Validation_Rule_noEmpty extends MW_Validation_Rule {

	/**
	 * バリデーションルール名を指定
	 */
	protected static $name = 'noempty';

	/**
	 * rule
	 * @param string $key name属性
	 * @param array $option
	 * @return string エラーメッセージ
	 */
	public function rule( $key, array $options = array() ) {
		$value = $this->Data->get( $key );
		if ( !is_null( $value ) && MWF_Functions::is_empty( $value ) ) {
			$defaults = array(
				'message' => __( 'Please enter.', MWF_Config::DOMAIN )
			);
			$options = array_merge( $defaults, $options );
			return $options['message'];
		}
	}

	/**
	 * admin
	 * @param numeric $key バリデーションルールセットの識別番号
	 * @param array $value バリデーションルールセットの内容
	 */
	public static function admin( $key, $value ) {
		?>
		<label><input type="checkbox" <?php checked( $value[self::getName()], 1 ); ?> name="<?php echo MWF_Config::NAME; ?>[validation][<?php echo $key; ?>][<?php echo esc_attr( self::getName() ); ?>]" value="1" /><?php esc_html_e( 'No empty', MWF_Config::DOMAIN ); ?></label>
		<?php
	}
}