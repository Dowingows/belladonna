<nav>
  <ul class="pagination ">
    <li>
        <?= $this->Paginator->prev('<span aria-hidden="true">&laquo;</span>',['escape'=>false]) ?>
    </li>
    
    <?php if(!empty($this->Paginator->numbers())):?>
        <?= $this->Paginator->numbers() ?>
    <?php else:?>
    <li><a href="" onclick="return false;"><span aria-hidden="true">1</span></a></li>
    <?php endif;?>
    <li>
        <?= $this->Paginator->next('<span aria-hidden="true">&raquo;</span>',['escape'=>false]) ?>
    </li>
  </ul>
</nav>