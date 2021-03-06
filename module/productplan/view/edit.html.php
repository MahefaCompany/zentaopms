<?php
/**
 * The edit view of productplan module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     productplan
 * @version     $Id: edit.html.php 4728 2013-05-03 06:14:34Z chencongzhi520@gmail.com $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/kindeditor.html.php';?>
<?php js::set('weekend', $config->project->weekend);?>
<?php js::import($jsRoot . 'misc/date.js');?>
<div id='mainContent' class='main-content'>
  <div class='center-block'>
    <div class='main-header'>
      <h2>
        <span class='prefix'><?php echo html::icon($lang->icons['plan']);?></span>
        <strong><?php echo html::a(inlink('view', "id=$plan->id"), $plan->title);?></strong>
        <small><?php echo $lang->arrow . ' ' . $lang->productplan->edit;?></small>
      </h2>
    </div>
    <form class='load-indicator main-form form-ajax' method='post' target='hiddenwin' id='dataform'>
      <table class='table table-form'>
        <tbody>
          <tr>
            <th><?php echo $lang->productplan->product;?></th>
            <td class='muted'><?php echo $product->name;?></td><td></td><td></td>
          </tr>
          <?php if($product->type != 'normal'):?>
          <tr>
            <th><?php echo $lang->product->branch;?></th>
            <td><?php echo html::select('branch', $branches, $plan->branch, 'class="form-control"');?></td><td></td><td></td>
          </tr>
          <?php endif;?>
          <tr>
            <th><?php echo $lang->productplan->title;?></th>
            <td><?php echo html::input('title', $plan->title, "class='form-control' autocomplete='off' required");?></td><td></td><td></td>
          </tr>
          <tr>
            <th><?php echo $lang->productplan->begin;?></th>
            <td><?php echo html::input('begin', $plan->begin, "class='form-control form-date' required");?></td><td></td><td></td>
          </tr>
          <tr>
            <th><?php echo $lang->productplan->end;?></th>
            <td>
              <?php $disabled = $plan->end == '2030-01-01' ? ' disabled="disabled"' : '';?>
              <?php echo html::input('end', empty($disabled) ? $plan->end : '', 'class="form-control form-date"' . $disabled);?>
            </td>
            <td colspan='2'><?php echo html::radio('delta', $lang->productplan->endList , '', "onclick='computeEndDate(this.value)'");?></td>
          </tr>
          <tr>
            <th><?php echo $lang->productplan->desc;?></th>
            <td colspan='3'><?php echo html::textarea('desc', htmlspecialchars($plan->desc), "rows='10' class='form-control kindeditor' hidefocus='true'");?></td>
          </tr>
          <tr>
            <td colspan='4' class='text-center'>
              <?php 
              echo html::submitButton('', '', 'btn btn-wide btn-primary');
              echo html::backButton('', '', 'btn btn-wide btn-gray');
              echo html::hidden('product', $product->id);
              ?>
            </td>
          </tr>
        </tbody>
      </table>
    </form>
  </div>
</div>
<?php include '../../common/view/footer.html.php';?>
