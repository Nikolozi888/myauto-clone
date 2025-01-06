document.getElementById('brand').addEventListener('change', function () {
    const brandId = this.value;
    const modelSelect = document.getElementById('model');

    modelSelect.innerHTML = '<option value="">აირჩიეთ მოდელი</option>';

    if (brandId) {
        fetch(`/get-models?brand_id=${encodeURIComponent(brandId)}`) // Use encodeURIComponent for safety
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (Array.isArray(data)) {
                    data.forEach(model => {
                        const option = document.createElement('option');
                        option.value = model.id;
                        option.textContent = model.name;
                        modelSelect.appendChild(option);
                    });
                } else {
                    console.error('Invalid data format:', data);
                }
            })
            .catch(error => {
                console.error('Error fetching models:', error);
                alert('მოდელების მიღებისას მოხდა შეცდომა. გთხოვთ სცადოთ თავიდან.');
            });
    }
});


document.getElementById('filterForm').addEventListener('submit', function (event) {
    const button = document.getElementById('filterButton');
    button.disabled = true;
    button.innerHTML = 'Loading...';
});

window.addEventListener('DOMContentLoaded', () => {
    const queryParams = new URLSearchParams(window.location.search);
    const button = document.getElementById('filterButton');
    if (queryParams.toString()) {
        button.innerHTML =
            '<a href="/cars" id="filterButton" class="bg-orange-500 text-white px-4 py-2 rounded-md w-full">დააჭირეთ რომ ნახოთ გაფილტრული მანქანები</button>';
    }
});

document.getElementById('formPage').addEventListener('submit', function (event) {
    const formPage = document.getElementById('formPage');
    formPage.disabled = true;
});

window.addEventListener('DOMContentLoaded', () => {
    const queryParams = new URLSearchParams(window.location.search);
    const formPage = document.getElementById('formPage');
    if (queryParams.toString()) {
        formPage.innerHTML = '<h1>დააჭირეთ ღილაკს რომ ნახოთ გაფილტრული ავტომობილები</h1>';
    }
});




document.getElementById('buttonNormal').addEventListener('submit', function (event) {
    const buttonNormal = document.getElementById('buttonNormal');
    buttonNormal.disabled = true;
});

window.addEventListener('DOMContentLoaded', () => {
    const queryParams = new URLSearchParams(window.location.search);
    const buttonNormal = document.getElementById('buttonNormal');
    if (queryParams.toString()) {
        buttonNormal.innerHTML =
            '<a href="/" class="p-3 bg-green-400">თუ გსურთ ფილტრაციაში დაბრუნება დააჭირეთ ამ ღილაკს</a>';
    }
});



function toggleBodyDropdown() {
    const dropdownContent = document.getElementById('bodydropdownContent');
    dropdownContent.classList.toggle('hidden');
}

// სხეულის ტიპის Dropdown დახურვა "არჩევა" ღილაკზე დაჭერისას
function closeBodyDropdown() {
    const dropdownContent = document.getElementById('bodydropdownContent');
    dropdownContent.classList.add('hidden');
    const selectedOption = document.querySelector('input[name="body_type[]"]:checked');
    if (selectedOption) {
        document.getElementById('selectedBodyOptions').innerText = selectedOption.nextElementSibling.innerText;
    }
}

// სხეულის ტიპის მონიშნული პარამეტრების განახლება
function updateBodySelectedOptions() {
    const selectedOption = document.querySelector('input[name="body_type[]"]:checked');
    if (selectedOption) {
        document.getElementById('selectedBodyOptions').innerText = selectedOption.nextElementSibling.innerText;
    }
}

function toggleFuelDropdown() {
    const dropdown = document.getElementById('fuelDropdownContent');
    dropdown.classList.toggle('hidden');
}

function updateFuelSelectedOptions() {
    const checkboxes = document.querySelectorAll('#fuelDropdownContent input[type="checkbox"]');
    const selectedOptions = Array.from(checkboxes)
        .filter(checkbox => checkbox.checked)
        .map(checkbox => checkbox.nextElementSibling.textContent.trim());
    document.getElementById('selectedFuelOptions').textContent = selectedOptions.length > 0 ?
        selectedOptions.join(', ') :
        'აირჩიეთ საწვავი';
}

function closeFuelDropdown() {
    document.getElementById('fuelDropdownContent').classList.add('hidden');
}

// Dropdown გახსნა/დახურვა
function toggleDropdown() {
    const dropdown = document.getElementById('dropdownContent');
    dropdown.classList.toggle('hidden');
}

// Dropdown დახურვა "არჩევა" ღილაკზე დაჭერისას
function closeDropdown() {
    const dropdown = document.getElementById('dropdownContent');
    dropdown.classList.add('hidden');
}

// მონიშნული პარამეტრების განახლება
function updateSelectedOptions() {
    const checkboxes = document.querySelectorAll('input[name="gearbox[]"]:checked');
    const selectedOptions = Array.from(checkboxes).map((checkbox) => checkbox.nextElementSibling.textContent
        .trim());
    const selectedText = selectedOptions.length > 0 ? selectedOptions.join(', ') : 'აირჩიეთ გადაცემათა კოლოფი';

    // განახლება Trigger ღილაკზე
    document.getElementById('selectedOptions').textContent = selectedText;
}
