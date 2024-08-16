var searchInput = document.getElementById('searchInput');
searchInput.addEventListener('input', function() {
  var searchTerm = searchInput.value.toLowerCase();

  if (searchTerm.trim() === '') {
    hideResultsPopup();
  } else {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '../utils/getAllUsers.php?searchTerm=' + searchTerm, true);
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        var data = JSON.parse(xhr.responseText);
        showAutocompleteResults(data);
      }
    };
    xhr.send();
  }
});


function fetchUserDetails(username) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '../pages/profile_admin.php?username=' + encodeURIComponent(username), true);
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        var response = xhr.responseText;
      }
    };
    xhr.send();
}

var resultsPopup = document.getElementById('resultsPopup');

function showResultsPopup() {
  resultsPopup.style.display = 'block';
}

function hideResultsPopup() {
  resultsPopup.style.display = 'none';
}

function createListItem(username) {
    var listItem = document.createElement('li');
    listItem.textContent = username;
    listItem.addEventListener('click', function() {
      window.location.href = '../pages/profile_admin.php?username=' + encodeURIComponent(username);
    });
    return listItem;
}

function clearResultsList() {
    var resultsList = document.getElementById('resultsList');
    resultsList.innerHTML = '';
}

function showAutocompleteResults(results) {
    var resultsList = document.getElementById('resultsList');
    clearResultsList();

    results.forEach(function(result) {
      var listItem = createListItem(result);
      resultsList.appendChild(listItem);
    });

    showResultsPopup();
}

