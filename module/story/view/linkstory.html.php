<?php
/**
 * The link story view of story module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Fei Chen <chenfei@cnezsoft.com>
 * @package     story
 * @version     $Id: linkstory.html.php 4129 2016-03-09 08:58:13Z chenfei $
 * @link        http://www.zentao.net
 */
?>
<?php include './header.html.php';?>
<div class='main-content' id='mainContent'>
  <div class='main-header'>
    <h2>
      <span class='prefix'><?php echo html::icon($lang->icons['story']);?> <strong><?php echo $story->id;?></strong></span>
      <strong><?php echo html::a($this->createLink('story', 'view', "storyID=$story->id"), $story->title);?></strong>
      <small><?php echo $lang->arrow . $lang->story->linkStory;?></small>
    </h2>
  </div>
  <div id='queryBox' class='show'></div>
  <form method='post' target='hiddenwin' id='linkStoryForm' class='main-table table-story' data-ride="table">
    <table class='table' id='storyList'>
      <?php if($stories2Link):?>
      <thead>
      <tr>
        <th class='c-id'>
          <div class="checkbox-primary check-all" title="<?php echo $lang->selectAll?>">
            <label></label>
          </div>
          <?php echo $lang->idAB;?>
        </th>
        <th class='w-pri'><?php echo $lang->priAB;?></th>
        <th><?php echo $lang->story->product;?></th>
        <th><?php echo $lang->story->title;?></th>
        <th><?php echo $lang->story->plan;?></th>
        <th class='w-user'><?php echo $lang->openedByAB;?></th>
        <th class='w-80px'><?php echo $lang->story->estimateAB;?></th>
      </tr>
      </thead>
      <tbody>
      <?php $storyCount = 0;?>
      <?php foreach($stories2Link as $story2Link):?>
      <?php $storyLink = $this->createLink('story', 'view', "storyID=$story2Link->id");?>
      <tr class='text-center'>
        <td class='c-id'>
          <div class="checkbox-primary">
            <input type='checkbox' name='stories[]'  value='<?php echo $story2Link->id;?>'/> 
            <label></label>
            <?php echo html::a($storyLink, sprintf('%03d', $story2Link->id));?>
          </div>
        </td>
        <td><span class='<?php echo 'pri' . zget($lang->story->priList, $story2Link->pri, $story2Link->pri)?>'><?php echo zget($lang->story->priList, $story2Link->pri, $story2Link->pri);?></span></td>
        <td><?php echo html::a($this->createLink('product', 'browse', "productID=$story2Link->product&branch=$story2Link->branch"), $products[$story2Link->product], '_blank');?></td>
        <td class='text-left nobr' title="<?php echo $story2Link->title?>"><?php echo html::a($storyLink, $story2Link->title, '_blank');?></td>
        <td><?php echo $story2Link->planTitle;?></td>
        <td><?php echo zget($users, $story2Link->openedBy);?></td>
        <td><?php echo $story2Link->estimate;?></td>
      </tr>
      <?php $storyCount ++;?>
      <?php endforeach;?>
      </tbody>
    </table>
    <div class='table-footer'>
      <div class="checkbox-primary check-all"><label><?php echo $lang->selectAll?></label></div>
      <div class="table-actions btn-toolbar">
        <?php if($storyCount) echo html::submitButton();?>
      </div>
      <?php echo html::hidden('story', $story->id);?>
    </div>
    <?php endif;?>
  </form>
</div>
<script type='text/javascript'>
$(function(){ajaxGetSearchForm();});
</script>
<?php include '../../common/view/footer.html.php';?>
