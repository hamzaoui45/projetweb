<h1>Modifier un événement</h1>
<form method="POST" action="/events/edit/<?= $event['id'] ?>">
    <label>Titre:</label>
    <input type="text" name="titre" value="<?= $event['titre'] ?>" required>
    <label>Date:</label>
    <input type="date" name="date" value="<?= $event['date'] ?>" required>
    <label>Longitude:</label>
    <input type="text" name="longi" value="<?= $event['longi'] ?>" required>
    <label>Latitude:</label>
    <input type="text" name="lat" value="<?= $event['lat'] ?>" required>
    <button type="submit">Modifier</button>
</form>
