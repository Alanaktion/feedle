var storage;
if (chrome.runtime.id.endsWith('@temporary-addon')) {
  storage = chrome.storage.local;
} else {
  storage = chrome.storage.sync;
}

var message = document.querySelector('#message');

// Check if there is a URL specified.
storage.get('base_url', function(items) {
  // If there is a base URL specified, load Feedle.
  if (items && items.base_url) {
    let iframe = document.querySelector('iframe');
    iframe.style.display = 'block';
    iframe.src = items.base_url;
  } else {
    var optionsUrl = chrome.extension.getURL('options.html');
    message.innerHTML = 'Set your Feedle base URL in the ' +
        '<a target="_blank" href="' + optionsUrl + '">options page</a> first.';
  }
});

