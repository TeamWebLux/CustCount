<?php 

$Submit='<button type="submit" class="btn btn-primary">Submit</button>';
$Cancel='<button type="reset" class="btn btn-danger">Reset</button>';

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
function field($label, $type, $id, $placeholder, $value = "",$required="",$ftype="") {
    $html = '<div class="form-group">
                <label class="form-label" for="' . $id . '">' . $label . '</label>
                <input type="' . $type . '" name="'.$id.'" class="form-control" id="' . $id . '" value="' . htmlspecialchars($value) . '" placeholder="' . $placeholder . '" '.$required.' '.$ftype.'>
            </div>';

    return $html;
}


function select($label, $id, $name, $options, $selectedOption = null) {
    $html = '<div class="form-group">
                <label class="form-label" for="' . $id . '">' . $label . '</label>
                <select class="form-select" id="' . $id . '" name="' . $name . '">';

    foreach ($options as $option) {
        $selected = ($option == $selectedOption) ? 'selected' : '';
        $html .= '<option ' . $selected . '>' . $option . '</option>';
    }

    $html .= '</select>
            </div>';

    return $html;
}

// Example usage:


$formend=' </form>

</div> <!-- end card-body -->
</div> <!-- end card-->
</div> <!-- end col -->
</div>';
?>