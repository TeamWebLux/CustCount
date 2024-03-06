<?php 
$name='<div class="mb-3 col-md-6">
<label for="inputname" class="form-label">Name</label>
<input type="text" class="form-control" id="inputname"
    placeholder="abc">
</div>';
$ID='<div class="mb-3 col-md-6">
<label for="inputid" class="form-label">ID</label>
<input type="text" class="form-control" id="inputid"
    placeholder="fbid instaid">
</div>';
$Refelect=' <div class="mb-3 col-md-6">
<label for="inputreflect" class="form-label">Reflect</label>
<input type="text" class="form-control" id="inputreflect"
    placeholder="Reflect amount">
</div>';
$Bonus='                                            <div class="mb-3 col-md-6">
<label for="inputBonus" class="form-label">Bonus</label>
<input type="text" class="form-control" id="inputBonus"
    placeholder="Bonus Amount">
</div>';

$action=$_GET['action'];

if(isset($action)){
    if($action="add_user"){
        echo $name;
        echo $ID;
        echo $Refelect;
        
    }
}





?>