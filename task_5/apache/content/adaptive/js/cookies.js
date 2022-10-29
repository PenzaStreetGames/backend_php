const theme_btn = document.querySelector(".theme-toggle");
let currentTheme = getCookie("theme");
const stylesheetLink = document.querySelector("#theme-link")
const lightThemeLink = "css/light_theme.css"
const darkThemeLink = "css/dark_theme.css"

const lang_btn = document.querySelector(".lang-toggle");
let currentLanguage = getCookie("lang");

const name_field = document.querySelector("#name_field")
const set_name_btn = document.querySelector(".set-name-button")
const name_span = document.querySelector("#name_span")
let username = getCookie("name");

if (currentTheme === "dark") {
    stylesheetLink.href = darkThemeLink
} else {
    stylesheetLink.href = lightThemeLink
}

if (username !== undefined) {
    name_span.innerHTML = username;
}

theme_btn.addEventListener("click", function () {
    if (currentTheme === "light") {
        currentTheme = "dark";
        stylesheetLink.href = darkThemeLink
    } else {
        currentTheme = "light"
        stylesheetLink.href = lightThemeLink
    }
    setCookie("theme", currentTheme);
});

lang_btn.addEventListener("click", function () {
    if (currentLanguage === "ru") {
        currentLanguage = "en";
    } else {
        currentLanguage = "ru";
    }
    console.log(currentLanguage);
    setCookie("lang", currentLanguage);
    location.reload();
})


set_name_btn.addEventListener("click", function () {
    let new_username = name_field.value;
    if (new_username !== "") {
        username = new_username;
        name_span.innerHTML = username;
        setCookie("name", new_username)
    }
})


function getCookie(name) {
    let matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}

function setCookie(name, value, options = {}) {

    options = {
        path: '/',
        ...options
    };

    if (options.expires instanceof Date) {
        options.expires = options.expires.toUTCString();
    }

    let updatedCookie = encodeURIComponent(name) + "=" + encodeURIComponent(value);

    for (let optionKey in options) {
        updatedCookie += "; " + optionKey;
        let optionValue = options[optionKey];
        if (optionValue !== true) {
            updatedCookie += "=" + optionValue;
        }
    }

    document.cookie = updatedCookie;
}