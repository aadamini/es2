<?php 
	$t='clienti';
	$url='?p='.$t;
	if (!empty($_REQUEST['del'])) : 
		$rec=R::load($t, intval($_REQUEST['del']));
		try{
			R::trash($rec);
		} catch (RedBeanPHP\RedException\SQL $e) {
			$msg=$e->getMessage();
		}
	endif;	
	if (!empty($_POST['nome'])) : 
		if (empty($_POST['id'])){
			$rec=R::dispense($t);
		}else{
			$rec=R::load($t,intval($_POST['id']));
		}
		foreach ($_POST as $key=>$value){
			$rec[$key]=$value;
		}
		try {
			$id=R::store($rec);
		} catch (RedBeanPHP\RedException\SQL $e) {
			?>
			<h4 class="msg label error">
				<?=$e->getMessage()?>
			</h4>
			<?php
		}	
	endif;
	
	$data=R::findAll($t);
?>
<h1>
	<a href="index.php">
		Clienti
	</a>
	
</h1>

<div class="container-fluid">



	<?php foreach ($data as $dt) : ?>
            <div class="row">
		<div class="col-sm-12 ">
			<form method="post" action="<?=$url?>">
                            <div class="form-group">
                                <div class="col-sm-2">
				<input class="form-control" name="nome"  value="<?=$dt->nome?>"  />
                                </div>
                                <div class="col-sm-3">
                                <input class="form-control" name="email"  value="<?=$dt->email?>"  />
                                </div>
                                <div class="col-sm-2">
                                <input class="form-control" name="telefono"  value="<?=$dt->telefono?>"  />
                                </div>
                                <div class="col-sm-2">
                                <input class="form-control" name="cellulare"  value="<?=$dt->cellulare?>"  />
                                </div>
                                
                                <div class="col-sm-1">
				<button type="submit" class="btn btn-success" tabindex="-1">
					Salva
				</button>
                                </div>
                                <div class="col-sm-1">
				<a href="?p=<?=$url?>&del=<?=$dt['id']?>" class="btn btn-danger" tabindex="-1">
					Elimina
				</a>
                                </div>
                            </div>
                            <input  type="hidden" name="id" value="<?=$dt->id?>" />
			</form>
		</div>
            </div>
	<?php endforeach; ?>
            <div class="row">
		<div class="col-sm-12">
                    <form method="post" action="<?=$url?>">
                        <div class="form-group">
                            <div class="col-sm-2">
                            <input class="form-control" name="nome" placeholder="Nome" autofocus />
                            </div>
                            <div class="col-sm-3">
                            <input class="form-control" name="email" placeholder="Email" autofocus />
                            </div>
                            <div class="col-sm-2">
                            <input class="form-control" name="telefono" placeholder="Telefono" autofocus />
                            </div>
                            <div class="col-sm-2">
                            <input class="form-control" name="cellulare" placeholder="Cellulare" autofocus />
                            </div>
                            <div class="col-sm-1">
                            <button type="submit" class="btn btn-primary">
                                    Inserisci
                            </button>
                            </div>
                            <div class="col-sm-1">
                            </div>
                        </div>
                    </form>
	
                </div>
            </div>
</div>