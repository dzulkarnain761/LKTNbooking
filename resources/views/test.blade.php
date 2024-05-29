<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Selector</title>
    <style>
        #selectedItems {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ccc;
        }
        .removeButton {
            margin-left: 10px;
            color: red;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Select Items</h1>
    <select id="itemSelect">
        <option value="apple">Apple</option>
        <option value="pear">Pear</option>
        <option value="banana">Banana</option>
        <option value="orange">Orange</option>
    </select>
    <button id="addItemButton">Add Item</button>

    <div id="selectedItems">
        <h2>Selected Items</h2>
        <ul id="itemsList"></ul>
    </div>

    <script src="script.js"></script>
</body>

<script>
    document.getElementById('addItemButton').addEventListener('click', function() {
    const itemSelect = document.getElementById('itemSelect');
    const selectedItem = itemSelect.value;
    const itemsList = document.getElementById('itemsList');

    // Check if item is already in the list
    if (!Array.from(itemsList.children).some(item => item.textContent.includes(selectedItem))) {
        const listItem = document.createElement('li');
        listItem.textContent = selectedItem;

        // Create a remove button
        const removeButton = document.createElement('span');
        removeButton.textContent = 'Remove';
        removeButton.className = 'removeButton';
        removeButton.addEventListener('click', function() {
            itemsList.removeChild(listItem);
        });

        listItem.appendChild(removeButton);
        itemsList.appendChild(listItem);
    }
});

</script>
</html>



