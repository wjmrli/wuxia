<?php
namespace yii\grid;

class ActionColumn extends \yii\grid\ActionColumn
{
  public $template = '{:view} {:update} {:delete}';
  /**
   * ��д�˱�ǩ��Ⱦ������
   * @param mixed $model
   * @param mixed $key
   * @param int $index
   * @return mixed
   */
  protected function renderDataCellContent($model, $key, $index)
  {
    return preg_replace_callback('/\\{([^}]+)\\}/', function ($matches) use ($model, $key, $index) {
      list($name, $type) = explode(':', $matches[1].':'); // �õ���ť��������
      if (!isset($this->buttons[$type])) { // ������Ͳ����� Ĭ��Ϊview
        $type = 'view';
      }
      if ('' == $name) { // ����Ϊ�գ���������Ϊ����
        $name = $type;
      }
      $url = $this->createUrl($name, $model, $key, $index);
      return call_user_func($this->buttons[$type], $url, $model, $key);
    }, $this->template);
  }
}
?>