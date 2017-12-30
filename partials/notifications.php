<?php if(isset($_SESSION['success'])): ?>
	<div class="alert alert-success">                           
        <span><?php echo $_SESSION['success'];unset($_SESSION['success']); ?></span>
    </div>
<?php endif; ?>

<?php if(isset($_SESSION['error'])): ?>
    <div class="alert alert-danger">                           
        <span><?php echo $_SESSION['error'];unset($_SESSION['error']); ?></span>
    </div>    
<?php endif; ?>