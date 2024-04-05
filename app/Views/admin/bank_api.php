<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Form</title>
</head>
<body>
    <h1>Daftar Bank</h1>
    <form action="#">
        <select name="bank" id="bank">
            <?php foreach ($banks as $bank) : ?>
                <option value="<?= $bank[1]; ?>"><?= $bank[3]; ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Pilih</button>
    </form>
</body>
</html>
