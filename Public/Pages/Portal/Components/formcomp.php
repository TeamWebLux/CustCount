<?php 

$name='<div class="form-group">
<label class="form-label" for="Inputname">Name</label>
<input type="text" name="name" class="form-control" id="exampleInputText1" value="" placeholder="Enter Name">
</div>';
$First_name='<div class="form-group mt-2">
<label class="form-label" for="InputFirstname">Last name</label>
<input type="text" name="fname" class="form-control" id="InputFirstname" aria-describedby="FirstHelp" placeholder="Enter First Name">
</div>';
$last_name='<div class="form-group mt-2">
    <label class="form-label" for="Inputlastname">Last name</label>
    <input type="text" name="lname" class="form-control" id="Inputlastname" aria-describedby="lastlHelp" placeholder="Enter Last Name">
    </div>';

$email_id='<div class="form-group mt-2">
<label class="form-label" for="Inputemail">Email address</label>
<input type="email" name="email" class="form-control" id="Inputemail1" aria-describedby="emailHelp" placeholder="Enter Email">
</div>';
$Password='<div class="form-group mt-2">
<label class="from-label" for="Password">Password</label>
<input type="password" name="password" class="form-control" id="Inputpassword" aria-describedby="passwordhelp" placeholder="Enter Password">
</div>';

$url_input='<div class="form-group">
<label class="form-label" for="exampleInputurl">Url Input</label>
<input type="url" name="input" class="form-control" id="exampleInputurl" value="" placeholder="Enter Url">
</div>';
$Teliphone_Input='<div class="form-group">
<label class="form-label" for="exampleInputphone">Teliphone Input</label>
<input type="tel" name="telephone number" class="form-control" id="exampleInputphone" value="">
</div>';
$Number_Input=' <div class="form-group">
<label class="form-label" for="exampleInputNumber1">Number Input</label>
<input type="number" name="number" class="form-control" id="exampleInputNumber1" value="">
</div>';
$Date_Input='<div class="form-group">
<label class="form-label" for="exampleInputdate">Date Input</label>
<input type="date" name="date" class="form-control" id="exampleInputdate" value="">
</div>';
$Month_Input='<div class="form-group">
<label class="form-label" for="exampleInputmonth">Month Input</label>
<input type="month" name="month" class="form-control" id="exampleInputmonth" value="">
</div>';
$Week_Input='<div class="form-group">
<label class="form-label" for="exampleInputweek">Week Input</label>
<input type="week" name="week" class="form-control" id="exampleInputweek" value="">
</div>';
$Time_Input='<div class="form-group">
<label class="form-label" for="exampleInputtime">Time Input</label>
<input type="time" name="time" class="form-control" id="exampleInputtime" value="">
</div>';
$Date_and_Time_Input=' <div class="form-group">
<label class="form-label" for="exampleInputdatetime">Date and Time Input</label>
<input type="datetime-local" name="date and time" class="form-control" id="exampleInputdatetime" value="">
</div>';
$Example_textarea=' <div class="form-group">
<label class="form-label" for="exampleFormControlTextarea1">Example textarea</label>
<textarea name="textarea" class="form-control" id="exampleFormControlTextarea1" rows="5"></textarea>
</div>';
$Submit='<button type="submit" class="btn btn-primary">Submit</button>';
$Cancel='<button type="submit" class="btn btn-danger">Cancel</button>';

$Remember_me=' <div class="form-check">
<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault3">
<label class="form-check-label" for="flexCheckDefault3">
    Remember me
</label>
</div>';

$Small='<div class="form-group">
<label class="form-label">Small</label>
<select class="form-select form-select-sm mb-3 shadow-none">
    <option selected="">Open this select menu</option>
    <option value="1">One</option>
    <option value="2">Two</option>
    <option value="3">Three</option>
</select>
</div>';

$Default='<div class="form-group">
<label class="form-label">Default</label>
<select class="form-select mb-3 shadow-none">
    <option selected="">Open this select menu</option>
    <option value="1">One</option>
    <option value="2">Two</option>
    <option value="3">Three</option>
</select>
</div>';
$Large='<div class="form-group">
<label class="form-label">Large</label>
<select class="form-select form-select-lg shadow-none">
    <option selected="">Open this select menu</option>
    <option value="1">One</option>
    <option value="2">Two</option>
    <option value="3">Three</option>
</select>
</div>';
$Select_Input='<div class="form-group">
<label class="form-label" for="exampleFormControlSelect1">Select Input</label>
<select class="form-select" id="exampleFormControlSelect1">
<option selected="" disabled="">Select your age</option>
<option>0-18</option>
<option>18-26</option>
<option>26-46</option>
<option>46-60</option>
<option>Above 60</option>
</select>
</div>';

$Example_multiple_select='    <div class="form-group">
<label class="form-label" for="exampleFormControlSelect2">Example multiple select</label>
<select multiple="" class="form-select" id="exampleFormControlSelect2">
<option>select-1</option>
<option>select-2</option>
<option>select-3</option>
<option>select-4</option>
<option>select-5</option>
<option>select-6</option>
<option>select-7</option>
<option>select-8</option>
</select>
</div>';
// $title ="hello";

function fhead($title = "", $heading = "",$faction="") {
    $formstart = '<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">' . $title . '</h4>
                    <p class="text-muted mb-0">' .$heading . '</p>
                </div>
                <div class="card-body">
                    <form action='.$faction.' method="POST">';
    return $formstart;
}
function field($label, $type, $id, $placeholder, $value = "") {
    $html = '<div class="form-group">
                <label class="form-label" for="' . $id . '">' . $label . '</label>
                <input type="' . $type . '" name="'.$id.'" class="form-control" id="' . $id . '" value="' . htmlspecialchars($value) . '" placeholder="' . $placeholder . '">
            </div>';

    return $html;
}

$formend=' </form>

</div> <!-- end card-body -->
</div> <!-- end card-->
</div> <!-- end col -->
</div>';
?>