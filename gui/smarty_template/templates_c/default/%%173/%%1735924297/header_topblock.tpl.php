<?php /* Smarty version 2.6.0, created on 2009-01-13 00:57:00
  compiled from common/header_topblock.tpl */ ?>
<table cellspacing="0"  class="titlebar" border=0>
    <tr valign=top  class="titlebar" >
        <td bgcolor="<?php echo $this->_tpl_vars['top_bgcolor']; ?>
            " >
            &nbsp;<?php echo $this->_tpl_vars['sTitleImage']; ?>
            &nbsp;<font color="<?php echo $this->_tpl_vars['top_txtcolor']; ?>
                        "><?php echo $this->_tpl_vars['sToolbarTitle']; ?>
            </font>
            <?php if ($this->_tpl_vars['Subtitle']): ?>
                - <?php echo $this->_tpl_vars['Subtitle']; ?>

            <?php endif; ?>
        </td>
        <td bgcolor="<?php echo $this->_tpl_vars['top_bgcolor']; ?>
            " align=right><?php if (!$this->_tpl_vars['disableButton']): if ($this->_tpl_vars['pbAux2']): ?><a
                        href="<?php echo $this->_tpl_vars['pbAux2']; ?>
                        "><img <?php echo $this->_tpl_vars['gifAux2']; ?>
                            alt="" <?php echo $this->_tpl_vars['dhtml']; ?>
                            ></a><?php
                    endif;
                    if ($this->_tpl_vars['pbAux1']):
                        ?><a
                        href="<?php echo $this->_tpl_vars['pbAux1']; ?>
                        "><img <?php echo $this->_tpl_vars['gifAux1']; ?>
                            alt="" <?php echo $this->_tpl_vars['dhtml']; ?>
                            ></a><?php
                    endif;
                    if ($this->_tpl_vars['pbBack']):
                        ?><a
                        href="<?php echo $this->_tpl_vars['pbBack']; ?>
                        "><img <?php echo $this->_tpl_vars['gifBack2']; ?>
                            alt="" <?php echo $this->_tpl_vars['dhtml']; ?>
                            ></a><?php
            endif;
            if ($this->_tpl_vars['pbHelp']):
                ?><a
                        href="<?php echo $this->_tpl_vars['pbHelp']; ?>
                        "><img <?php echo $this->_tpl_vars['gifHilfeR']; ?>
                            alt="" <?php echo $this->_tpl_vars['dhtml']; ?>
                            ></a><?php
            endif;
            if ($this->_tpl_vars['breakfile']):
                ?><a
                        href="<?php echo $this->_tpl_vars['breakfile']; ?>
                        " <?php echo $this->_tpl_vars['sCloseTarget']; ?>
                        ><img <?php echo $this->_tpl_vars['gifClose2']; ?>
                            alt="<?php echo $this->_tpl_vars['LDCloseAlt']; ?>
                            " <?php echo $this->_tpl_vars['dhtml']; ?>
                            ></a><?php
            endif;
        endif;
                ?>
<?php if ($this->_tpl_vars['disableButton']): ?><a
                    href="<?php echo $this->_tpl_vars['pbHelp']; ?>
                    "><img <?php echo $this->_tpl_vars['gifHilfeR']; ?>
                        alt="" <?php echo $this->_tpl_vars['dhtml']; ?>
                        ></a><?php endif; ?>
        </td>
    </tr>
</table>