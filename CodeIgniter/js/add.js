$(document).ready(function() {
    $(".add").click(function() {
        var ligne = "<tr><td><input type='radio' name='true' value='trois'></td><td><input type='text' name='option[]' placeholder='Option 3'></td><td><a href=\"javascript:void(0);\" class=\"delete\">×</a></td></tr>";
        $("table.test").append(ligne);
    });
    $(document).on("click", "a.delete", function() {
        $(this).parents("table.test tr").remove();
    });
});