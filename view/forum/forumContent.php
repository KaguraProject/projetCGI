<div class="card">
	<div class="card-header">
          <a href="post/<?= $post->id ?>"><?= $post->titre ?></a>
          <time class="float-right">
            <i class="fa fa-calendar"></i> <?= $post->dateCreation ?>
          </time>
     
   	</div>
    <div class="card-body"> 
    	<div class="row">
    		
	        
	        <div class="col-md-9">
	        	<h6 maxlength="10"><?= $post->contenu ?></h6>
	        	<hr>
	        	<?= $users[$post->id_user]['prenom']." ".$users[$post->id_user]['nom'] ?><br>
	        </div>
	        <div class="col-md-3">
	            <li class="list-unstyled"> Commentaires: <?= $post->nbCommentaires ?></li>
	          
	        </div>
    	</div>
	    
	</div>    
</div>
<br>