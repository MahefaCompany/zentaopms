<?php
/**
 * The link bug view of productplan module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     productplan
 * @version     $Id: linkbug.html.php 5096 2013-07-11 07:02:43Z chencongzhi520@gmail.com $
 * @link        http://www.zentao.net
 */
?>
<div id='queryBox' class='show'></div>
<div id='unlinkBugList'>
  <form class='main-table table-bug' data-ride='table' method='post' id='unlinkedBugsForm' target='hiddenwin' action='<?php echo $this->createLink('productplan', 'linkBug', "planID=$plan->id&browseType=$browseType&param=$param&orderBy=$orderBy")?>'>
    <div class='table-header'>
      <div class='table-statistic'><?php echo html::icon('unlink');?> &nbsp;<strong><?php echo $lang->productplan->unlinkedBugs;?></strong></div>
    </div>
    <table class='table'>
      <thead>
      <tr>
        <th class='c-id text-center'><?php echo $lang->idAB;?></th>
        <th class='w-pri'><?php echo $lang->priAB;?></th>
        <th><?php echo $lang->bug->title;?></th>
        <th class='w-user'><?php echo $lang->openedByAB;?></th>
        <th class='w-user'><?php echo $lang->bug->assignedToAB;?></th>
        <th class='w-80px'><?php echo $lang->bug->status;?></th>
      </tr>
      </thead>
      <tbody>
      <?php $unlinkedCount = 0;?>
      <?php foreach($allBugs as $bug):?>
      <?php
      if(isset($planBugs[$bug->id])) continue;
      if($bug->plan and helper::diffDate($plans[$bug->plan], helper::today()) > 0) continue;
      ?>
      <tr>
        <td class='c-id'>
          <input class='ml-10px' type='checkbox' name='bugs[]'  value='<?php echo $bug->id;?>'/> 
          <?php printf('%03d', $bug->id);?>
        </td>
        <td><span class='<?php echo 'pri' . zget($lang->bug->priList, $bug->pri, $bug->pri);?>'><?php echo zget($lang->bug->priList, $bug->pri, $bug->pri)?></span></td>
        <td class='nobr' title='<?php echo $bug->title?>'><?php echo html::a($this->createLink('bug', 'view', "bugID=$bug->id", '', true), $bug->title, '', "data-toggle='modal' data-type='iframe' data-width='90%'");?></td>
        <td><?php echo $users[$bug->openedBy];?></td>
        <td><?php echo $users[$bug->assignedTo];?></td>
        <td class='text-center bug-<?php echo $bug->status?>'><?php echo $lang->bug->statusList[$bug->status];?></td>
      </tr>
      <?php $unlinkedCount++;?>
      <?php endforeach;?>
      </tbody>
      <?php if($unlinkedCount):?>
      <tfoot>
      <tr>
        <td colspan='6' class='text-left table-footer'>
          <div class='clearfix'>
            <?php echo html::selectButton() . html::submitButton($lang->productplan->linkBug);?>
            <?php echo html::a(inlink('view', "planID=$plan->id&type=bug&orderBy=$orderBy"), $lang->goback, '', "class='btn'");?>
          </div>
        </td>
      </tr>
      </tfoot>
      <?php endif;?>
    </table>
  </form>
</div>
<script>
$(function()
{
    ajaxGetSearchForm('#bugs .linkBox #queryBox');
    setModal();
})
</script>
