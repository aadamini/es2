<?php 
	$msg='';
	$tbl='ricevute';
	$id = (!empty($_REQUEST['id'])) ? intval($_REQUEST['id']) : false;
	$record=(empty($_REQUEST['id'])) ?  R::dispense($tbl) : R::load($tbl, intval($_REQUEST['id']));
	if (!empty($_POST['clienti_id'])) :
			foreach ($_POST as $key=>$value){
				$record[$key]=$value;
			}
		try {
			R::store($record);
			$msg='Dati salvati correttamente ('.json_encode($record).') ';
		} catch (RedBeanPHP\RedException\SQL $e) {
			$msg=$e->getMessage();
		}
	endif;	
	
	if (!empty($_REQUEST['del'])) : 
		$record=R::load($tbl, intval($_REQUEST['del']));
		try{
			R::trash($record);
		} catch (RedBeanPHP\RedException\SQL $e) {
			$msg=$e->getMessage();
		}
	endif;
	
	$data=R::findAll($tbl, 'ORDER by id ASC LIMIT 999');
	$clienti=R::findAll('clienti');
	$new=!empty($_REQUEST['create']);
	foreach ($clienti as $opt){if ($opt->id == $record->clienti_id){$clienti=$opt;}}
?>

<h1>
	<a href="index.php">
		Indietro
	</a>
</h1>
 <!-- Filtra ricevute -->
        		



<div class="container-fluid">
        <div class="row">

               <div class="col-sm-2">
                    <div class="form-group">
                        <select class="form-control" name="clienti_id">
				<option />
				<?php foreach ($clienti as $opt) : ?>
					<option value="<?=$opt->id?>" <?=($opt->id==$record->clienti_id) ? 'selected' :'' ?> >
						<?=$opt->nome?>
					</option>
				<?php endforeach; ?>
			</select>
                    </div>
               </div>
               
                        <div class="col-sm-2">
			<input class="form-control" name="from" value="<?=date('Y-m-d',strtotime($record->dataemissione))?>" type="date" max="<?=date("Y-m-d")?>"/>
			</div>
                         <div class="col-sm-2">
                        <input class="form-control" name="to" value="<?=date('Y-m-d',strtotime($record->dataemissione))?>" type="date" max="<?=date("Y-m-d")?>"/>
			</div>
                         <div class="col-sm-1">
                        <a href="?p=<?=$tbl?>&client=<?=$opt->id?>&from=" class="btn btn-info">
				Filtra
			</a>
                        </div>    
                   </div>  
         </div>
</div>
       
		

					
		

