var storage;
if (chrome.runtime.id.endsWith('@temporary-addon')) {
  storage = chrome.storage.local;
} else {
  storage = chrome.storage.sync;
}

var urlInput = document.querySelector('input');

// Load previously saved URL
storage.get('base_url', function (items) {
  if (items.base_url) {
    urlInput.value = items.base_url;
  }
});

// Save URL on form submit
document.querySelector('form').addEventListener('submit', function (e) {
  var base_url = urlInput.value;
  if (!base_url) {
    message('Error: No URL specified');
    return;
  }

  storage.set({ 'base_url': base_url }, function () {
    message('Settings saved');
  });

  e.preventDefault();
});

function message(msg) {
  var message = document.querySelector('.message');
  message.innerText = msg;
  setTimeout(function() {
    message.innerText = '';
  }, 3000);
}
