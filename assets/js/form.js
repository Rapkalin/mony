export function categoryHandling() {
    const input = document.getElementById('item_form_newCategory');
    const select = document.getElementById('item_form_category');

    if (!input || !select) {
        console.warn('Category input or select not found');
        return;
    }

    input.addEventListener('keydown', function (event) {
        if (event.key === 'Enter') {
            event.preventDefault(); // Prevent form to be submitted

            const categoryName = input.value.trim();
            if (!categoryName) {
                alert('Missing category Name');
                return
            }

            fetch('/addCategoryAjax', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: new URLSearchParams({ newCategory: categoryName })
            })
                .then(res => res.json())
                .then(data => {
                    if (data.error) {
                        alert(data.error);
                        return;
                    }

                    // Update the options of the select
                    select.innerHTML = '';
                    data.forEach(cat => {
                        const option = document.createElement('option');
                        option.value = cat.id;
                        option.textContent = cat.name;
                        select.appendChild(option);
                    });

                    // Pre select a new category
                    const last = data[data.length - 1];
                    if (last) {
                        select.value = last.id;
                    }

                    input.value = '';
                })
                .catch(err => {
                    console.error(err);
                    alert('Error when adding new category');
                });
        }
    });
}
