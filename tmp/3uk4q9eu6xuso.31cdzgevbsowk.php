<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
</head>
<body>

<form method="post" action="#">
    <fieldset>
        <label>Email
            <input type="text" size="20" maxlength="20" name="email">
        </label><br>

        <label>State
            <select name="state" id="state">
                 <option>Washington</option>
            </select>
        </label><br>

        <label>Seeking: <br>
            <input type="checkbox" name="seeking[]" value="male">Male
            <input type="checkbox" name="seeking[]" value="female">Female
            <br>
            <input type="checkbox" name="seeking[]" value="lonely">Loneliness
            <input type="checkbox" name="seeking[]" value="despair">Despair
        </label>
    </fieldset>
    <button type="submit">Next --></button>
</form>

</body>
</html>