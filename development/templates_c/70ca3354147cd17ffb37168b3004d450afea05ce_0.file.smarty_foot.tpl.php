<?php
/* Smarty version 3.1.30, created on 2016-11-12 13:57:26
  from "C:\xampp\htdocs\part-db\templates\nextgen\smarty_foot.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_582711b658daa1_91419492',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '70ca3354147cd17ffb37168b3004d450afea05ce' => 
    array (
      0 => 'C:\\xampp\\htdocs\\part-db\\templates\\nextgen\\smarty_foot.tpl',
      1 => 1478951218,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_582711b658daa1_91419492 (Smarty_Internal_Template $_smarty_tpl) {
?>
            <?php if (isset($_smarty_tpl->tpl_vars['messages']->value)) {?>
                <div class="panel panel-default">
                    <form action="" method="post" class="panel-body">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['messages']->value, 'msg');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['msg']->value) {
?>
                            <?php if (isset($_smarty_tpl->tpl_vars['msg']->value['text'])) {?>
                                <?php if (isset($_smarty_tpl->tpl_vars['msg']->value['strong'])) {?><strong><?php }?>
                                <?php if (isset($_smarty_tpl->tpl_vars['msg']->value['color'])) {?><font color="<?php echo $_smarty_tpl->tpl_vars['msg']->value['color'];?>
"><?php }?>
                                <?php echo $_smarty_tpl->tpl_vars['msg']->value['text'];?>

                                <?php if (isset($_smarty_tpl->tpl_vars['msg']->value['color'])) {?></font><?php }?>
                                <?php if (isset($_smarty_tpl->tpl_vars['msg']->value['strong'])) {?></strong><?php }?>
                            <?php }?>

                            <?php if (isset($_smarty_tpl->tpl_vars['msg']->value['html'])) {?>
                                <?php echo $_smarty_tpl->tpl_vars['msg']->value['html'];?>

                            <?php }?>

                            <?php if (!isset($_smarty_tpl->tpl_vars['msg']->value['no_linebreak'])) {?><br><?php }?>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                    </form>
                </div>
            <?php }?>

         </div> <!-- .container-float -->
      </div> <!-- page-content-wrapper -->

      </main>

</div>   <!-- Wrapper -->
   </body>

</html>
<?php }
}