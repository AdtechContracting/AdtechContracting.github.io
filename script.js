	// This function loads the content of a given URL into the container element
function loadContent(url) {
    $("#content").load(url, function() {
        // This callback function runs after the content is loaded
        console.log("Content loaded from " + url);
    });
}
//concat(url,".html")
// This function updates the URL of the browser using the history API
function updateURL(url) {
    // The first argument is the state object, which can store any data you want
    // The second argument is the title, which is currently ignored by most browsers
    // The third argument is the URL, which will be displayed in the address bar
    history.pushState({url: url}, "", url);
}

// This function handles the popstate event, which is triggered when the user clicks the back or forward button of the browser
function handlePopstate(event) {
    // The event object has a state property, which contains the data we stored in the history API
    // We can use this data to load the content of the previous or next page
    var url = event.state.url.concat("html");
    loadContent(url);
}

// This event listener runs when the window object is loaded
$(window).on("load", function() {
    // We load the default page of our website, which is the home page
    loadContent("home.html");
});

// This event listener runs when the user clicks on any link or button that has a href attribute
$("a[href]").on("click", function(event) {
//function onClickEvent($"a[href]") {
    // We prevent the default behavior of the link or button, which is to load the href attribute as a new page
    event.preventDefault();
    // We get the value of the href attribute, which is the URL of the page we want to load
    var url = $(this).attr("id").concat("html");
    // We load the content of the page into the container element
    loadContent(url);
    // We update the URL of the browser using the history API
    updateURL(url);
});

// This event listener runs when the user clicks the back or forward button of the browser
$(window).on("popstate", function(event) {
    // We handle the popstate event using the function we created
    //handlePopstate(event);
});
