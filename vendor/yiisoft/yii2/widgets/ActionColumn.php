<?php
namespace yii\grid;

class ActionColumn extends \yii\grid\ActionColumn
{
  public $template = '{:view} {:update} {:delete}';
  /**
   * 重写了标签渲染方法。
   * @param mixed $model
   * @param mixed $key
   * @param int $index
   * @return mixed
   */
  protected function renderDataCellContent($model, $key, $index)
  {
    return preg_replace_callback('/\\{([^}]+)\\}/', function ($matches) use ($model, $key, $index) {
      list($name, $type) = explode(':', $matches[1].':'); // 得到按钮名和类型
      if (!isset($this->buttons[$type])) { // 如果类型不存在 默认为view
        $type = 'view';
      }
      if ('' == $name) { // 名称为空，就用类型为名称
        $name = $type;
      }
      $url = $this->createUrl($name, $model, $key, $index);
      return call_user_func($this->buttons[$type], $url, $model, $key);
    }, $this->template);
  }
}
?>