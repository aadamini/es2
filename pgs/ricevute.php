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
        
        
        
        if (!empty($_REQUEST['nome'])) :
                        
                        
                        $nome=$_REQUEST['nome'];
                        $fromfil=$_REQUEST['fromfil'];
                        $tofil=$_REQUEST['tofil'];
                        
                        if($nome=="Tutti"){$data=R::find('ricecli','where dataemissione between "'.$fromfil.'"and"'.$tofil.'"');};
                        $data=R::find('ricecli','where nome = "'.$nome.'"'.'or (dataemissione between "'.$fromfil.'"and"'.$tofil.'")');
		
	endif;
        
        
        
        $somma=0;
        $fil=R::findAll('filtri');
	$clienti=R::findAll('clienti');
	$new=!empty($_REQUEST['create']);
?>

<h1>
	<a href="index.php">
		<?=($id) ? ($new) ? 'Nuova ricevuta' : 'Ricevuta n. '.$id : 'Ricevute';?>
	</a>
</h1>
<!-- Form di input -->
<?php if ($id || $new) : ?>
    <div class="container-fluid">
        <div class="row">
           <div class="col-sm-12">
		<form method="post" action="?p=<?=$tbl?>">
                    <div class="form-group">
                        <div class="col-sm-1">
			<input class="form-control" name="numero" placeholder="Numero"  value="<?=($record->numero)?>"/>
                        </div>
                        <div class="col-sm-2">
			<input class="form-control" name="dataemissione" value="<?=date('Y-m-d',strtotime($record->dataemissione))?>" type="date" max="<?=date("Y-m-d")?>"/>
			</div>
                        <div class="col-sm-2">
			
			<select class="form-control" name="clienti_id">
				<option />
				<?php foreach ($clienti as $opt) : ?>
					<option value="<?=$opt->id?>" <?=($opt->id==$record->clienti_id) ? 'selected' :'' ?> >
						<?=$opt->nome?>
					</option>
				<?php endforeach; ?>
			</select>
                        </div>
                        <div class="col-sm-3">
			<input placeholder="Descrizione" class="form-control"name="descrizione"  value="<?=$record->descrizione?>" autofocus required  />			
			</div>
                        <div class="col-sm-1">
			<input placeholder="EUR" class="form-control" name="importo" value="<?=$record->importo?>" type="number" step="any" />
			</div>
                        
                        
                        
                        
                        <div class="col-sm-1">
                        <button type="submit" tabindex="-1" class="btn btn-success">
				Salva
			</button>
                        </div>    
			<div class="col-sm-1">
			<a href="?p=<?=$tbl?>" class="btn btn-primary" >
				Elenco
			</a>			
			</div>
                        <div class="col-sm-1">        
			<a href="?p=<?=$tbl?>&del=<?=$record->id?>" tabindex="-1" class="btn btn-warning">
				Elimina
			</a>
                        </div>
                        <?php if ($id) : ?>
				<input type="hidden" name="id" value="<?=$record->id?>" />
			<?php endif; ?>
                    </div>
		</form>
           </div>
        </div>
    </div>   
<?php else : ?>




<!-- Table di view -->
    <button data-toggle="collapse" class="btn btn-info" data-target="#collapse">Filtra</button>

    <div id="collapse" class="collapse">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
            <p>Inserisci Tutti per eseguire una ricerca solo sulla base della data</p>
                </div>
            </div>
           <?php foreach ($fil as $dot) : ?>
            <div class="row">
		<div class="col-sm-12">
                    <form method="post" action="index.php?p=ricevute">
                        <div class="form-group">
                            <div class="col-sm-2">
                            <input class="form-control" name="nome" value="<?=$dot->nome?>" placeholder="Tutti" autofocus required />
                            </div>
                           
                            <div class="col-sm-1">Da:</div>
                            <div class="col-sm-2">
                            <input class="form-control" name="fromfil" value="<?=$dot->fromfil?>" type="date" max="<?=date("Y-m-d")?>"/>
                            </div>

                            <div class="col-sm-1">A:</div>
                            <div class="col-sm-2">
                            <input class="form-control" name="tofil" value="<?=$dot->tofil?>" type="date" max="<?=date("Y-m-d")?>"/>
                            </div>
                            
                            <div class="col-sm-1">
                            <button type="submit" class="btn btn-info">
                                    <span class="glyphicon glyphicon-search"></span>
                            </button>
                            </div>
                            
                          
                        </div>
                    </form>
	
                </div>
            </div>
           <?php endforeach; ?>
        </div>
        
    </div>
        
       
        
	<div class="container">
            <div class="table-responsive">          
                <table class="table table-hover">
			<colgroup>
				<col style="width:150px" />
			</colgroup>
			<thead>
				<tr>
					<th>Cliente</th>
                                        <th>Numero</th>
					<th>Data</th>
					<th>Descrizione</th>
					<th>Importo</th>
					<th style="width:60px;text-align:center">Modifica</th>
					<th style="width:60px;text-align:center">Cancella</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($data as $r) : ?>
				<tr>
					<td>
                                            <a href="?p=clienti"><?=($r->clienti_id) ? $r->clienti->nome : ''?></a>
					</td>	
                                        <td>
						<a href="?p=ricevuta&id=<?=$r['id']?>"><?=($r->numero)?></a>
					</td>
					<td>
						<?=date('d/m/Y',strtotime($r->dataemissione))?>
					</td>
					<td>
						<?=$r->descrizione?>
					</td>
					<td style="text-align:right" >
                                                <?=sprintf("%.2f",$r->importo)?>
						<?php $somma=$somma+$r->importo?>
					</td>			
					<td style="text-align:center" >
						<a href="?p=<?=$tbl?>&id=<?=$r['id']?>" class="btn btn-warning">
							Mod.
						</a>
					</td>
					<td style="text-align:center" >
						<a href="?p=<?=$tbl?>&del=<?=$r['id']?>" class="btn btn-danger" tabindex="-1">
							x
						</a>
					</td>							
				</tr>		
			<?php endforeach; ?>
                       
			</tbody>
		</table>
            </div>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-8"></div>
                                 <div class="col-sm-1"><p>Totale:</p></div>
                                 <div class="col-sm-2"><p><?=sprintf("%.2f",$somma)?> EUR</p></div>
                            </div>
                        </div>
		<h4 class="msg">
			<?=$msg?>
		</h4>	
	</div>
<?php endif; ?>
        <a href="?p=<?=$tbl?>&create=1" class="btn btn-primary">Nuovo</a>
        
<script>
	var chg=function(e){
		console.log(e.name,e.value)
		document.forms.frm.elements[e.name].value=(e.value) ? e.value : null
	}	
</script>