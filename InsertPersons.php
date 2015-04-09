<!DOCTYPE html>
<html>
<head>
        <title>Yousef Aljohani - Entry Form</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
                <script>
                
                function selectLoc()
                {
                        var selection = document.getElementById("selection");
                        var index = selection.options[selection.selectedIndex].value;
                        
                        document.getElementById("lid").value = index;
                }
        
        </script>
        </head>
<body>
<br>
<div class="col-md-4">
        <form name='basic' method='POST' action='persons.php' onSubmit='return validate();'>
                <table class="table table-condensed" style="border: 1px solid #dddddd; border-radius: 5px; box-shadow: 2px 2px 10px;">
                        <tr><td colspan="2" style="text-align: center; border-radius: 5px; color: white; background-color:#333333;"><h2>Person Form</h2></td></tr>
                        <tr><td>Role: </td><td>  <select id="role" name="role">
                                        <option value="1" selected> Teacher </option>
                                        <option value="2"> Student </option>
                                        <option value="3"> Peer Reviewer </option>
                        </select></td></tr>
                        <tr><td>Secondary Role: </td><td><select id="secondary_role" name="secondary_role">
                                        <option value="1" selected> Teacher </option>
                                        <option value="2"> Student </option>
                                        <option value="3"> Peer Reviewer </option>
                                        </select></td></tr>
                        <tr><td>First Name: </td><td><input type='edit' name='first_name' value='' size='30'></td></tr>
                        <tr><td>Last name: </td><td><input type='edit' name='last_name' value='' size='20'></td></tr>
                        <tr><td>Email: </td><td><input type='edit' name='email' value='' size='30'></td></tr>
                        <tr><td>Password: </td><td><input type='edit' name='password_hash' value='' size='20'></td></tr>
                        <tr><td>School: </td><td><textarea style="resize: none;" name="school" cols="40" rows="3"></textarea></td></tr>
                        <tr><td style="vertical-align: middle;">Location: </td><td><select id="selection" class="form-control" onchange="selectLoc();">
                                                                                </select></td><td><input type="hidden" id="lid" value="1" name="locId"></td></tr>
                        <tr><td><input type="submit" name="submit" class="btn btn-success" value="Add Entry"></td>
                                <td style="text-align: right;"><input type="reset" class="btn btn-danger" value="Reset Form"></td></tr>
                </table>
                
                <a href="persons.php" class="btn btn-primary">Display Database</a>
        </form>
</div>

</body>
</html>
