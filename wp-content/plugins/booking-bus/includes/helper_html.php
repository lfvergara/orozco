<?php

/**
 *
 */
class HtmlHelper
{
  private $classname;

  function __construct($classname)
  {
    $this->classname = $classname;
  }

  public function create_input($name,$label=false,$type = 'text') {
    global $post;
    if($label): ?>
    <label for="Domicilio:"><?php _e($label, 'example' ); ?></label>
    <?php endif; ?>
    <input type="<?php echo ($name == 'birthday')?'date':$type; ?>" name="<?php echo $this->classname ?>[<?php echo $name ?>]" id="<?php echo $this->classname ?>_<?php echo $name ?>" value="<?php echo esc_attr( get_post_meta( $post->ID, $this->classname.'_'.$name, true ) ); ?>" />
    <?php
  }

  public function create_picker($name,$label=false) {
    global $post;
    if(label): ?>
    <label for="Domicilio:"><?php _e($label, 'example' ); ?></label>
    <?php endif; ?>
    <input class="datepicker" type="text" name="<?php echo $this->classname ?>[<?php echo $name ?>]" id="<?php echo $this->classname ?>_<?php echo $name ?>" value="<?php echo esc_attr( get_post_meta( $post->ID, $this->classname.'_'.$name, true ) ); ?>" />
    <?php
  }
  public function create_dropdown($name,$label,$options) {
    global $post;
    $value = esc_attr( get_post_meta( $post->ID, $this->classname.'_'.$name, true ) );
    ?>
    <label for="Domicilio:"><?php _e($label, 'example' ); ?></label>
    <select name="<?php echo $this->classname ?>[<?php echo $name ?>]" id="<?php echo $this->classname ?>_<?php echo $name ?>">
      <?php foreach ($options as $op_key => $op_name): ?>
      <option <?php if($value == $op_key): ?>selected="selected"<?php endif; ?> value="<?php echo $op_key ?>"><?php echo $op_name ?></option>
      <?php endforeach; ?>
    </select>
    <?php
  }

  public function create_dropdown_by_post($name,$label,$options) {
    global $post;
    $value = esc_attr( get_post_meta( $post->ID, $this->classname.'_'.$name, true ) );
    ?>
    <label for="Domicilio:"><?php _e($label, 'example' ); ?></label>
    <select name="<?php echo $this->classname ?>[<?php echo $name ?>]" id="<?php echo $this->classname ?>_<?php echo $name ?>">
      <?php foreach ($options as $op_name): ?>
      <option <?php if($value == $op_name->ID): ?>selected="selected"<?php endif; ?> value="<?php echo $op_name->ID ?>"><?php echo $op_name->post_title ?></option>
      <?php endforeach; ?>
    </select>
    <?php
  }
  public function status_asiento($value,$reserve) {
    if($value!='')
      return $reserve;
    else
      return "unset";
  }
}
