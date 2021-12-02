

<!DOCTYPE html>
<html lang="en" >

<head>

    <meta charset="UTF-8">

    <!--  網站圖示  -->
    <link rel="apple-touch-icon" type="image/png" href="images/logo-nbg.png"/>
    <link rel="shortcut icon" type="image/png" href="images/logo-nbg.png"/>
    <link rel="mask-icon" type="image/png" href="images/logo-nbg.png"/>


    <title>FA5 圖示</title>




    <style>
        @import url("https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;700;900&display=swap");
        @import url("https://use.fontawesome.com/releases/v5.15.3/css/all.css");
        *,
        *:before,
        *:after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            width: 100%;
            /* min-height: 100vh; */
            font-family: sans-serif;
            font-family: "Roboto", sans-serif;
            padding: 2rem 0;
            background-color: #E4DAC8;
        }

        .other-version-link {
            position: fixed;
            top: 0.5em;
            right: 0.5em;
            text-decoration: none;
            color: black;
        }

        .other-version-link:hover {
            color: red;
        }

        .other-version-link i {
            color: red;
        }

        header {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 1em;
        }

        header h1 {
            font-size: 3rem;
            text-align: center;
            position: relative;
        }

        header h1 > * {
            position: absolute;
            right: 0;
            top: calc(100% - 0.6rem);
            font-size: 0.8rem;
        }

        nav {
            position: sticky;
            top: 0;
            z-index: 999;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #ebebeb;
            box-shadow: 0 6px 5px rgba(0, 0, 0, 0.2);
        }

        nav .filter-container {
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            gap: 1em;
            justify-content: center;
            padding: 1em 0;
            text-align: center;
        }

        nav .import-fa > * {
            cursor: pointer;
        }

        nav .filter-container > * {
            display: flex;
            gap: 0.5em;
        }

        nav .import-fa > *:hover {
            text-decoration: underline;
        }

        nav .filter-container {
            font-weight: bold;
        }

        nav .filter-container label.active {
            text-decoration: underline;
            cursor: pointer;
            color: green;
        }

        main .icon-container {
            padding: 2em 1em;
            display: flex;
            flex-wrap: wrap;
            gap: 1em;
            justify-content: center;
        }

        main .icon-container .icon-wrapper {
            display: grid;
            grid-template-columns: 40px 150px 40px;
            gap: 0.5em;
            padding: 0.5em;
            background-color: white;
            border-radius: 0.25em;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            font-size: 0.8em;
        }

        main .icon-container .icon-wrapper .fa-icon-wrapper {
            display: grid;
            place-items: center;
            cursor: pointer;
        }

        main .icon-container .icon-wrapper .fa-icon-wrapper i {
            font-size: 25px;
        }

        main .icon-container .icon-wrapper .icon-name:hover,
        main .icon-container .icon-wrapper .icon-unicode:hover {
            text-decoration: underline;
            cursor: pointer;
        }

        main .icon-container .icon-wrapper .icon-name {
            align-self: center;
            justify-self: left;
        }

        main .icon-container .icon-wrapper .icon-unicode {
            place-self: center;
            color: #888;
        }

        .clipboard {
            position: fixed;
            z-index: 100;
            bottom: 0;
            left: 50%;
            pointer-events: none;
            cursor: pointer;
            border-radius: 0 0 0.5em 0.5em;
            background-color: white;
            box-shadow: 0 0 1rem 0 rgba(0, 0, 0, 0.5);
            padding: 1rem 2rem 3rem 2rem;
            transform: translate(-50%, 100%);
            opacity: 0;
            transition: all 250ms ease;
        }

        .clipboard.active {
            transform: translate(-50%, 0%);
            opacity: 1;
        }

        .clipboard h3 {
            text-align: center;
            margin-bottom: 0.5em;
        }

        .tempSVG {
            display: none;
        }
    </style>

    <script>
        window.console = window.console || function(t) {};
    </script>



    <script>
        if (document.location.search.match(/type=embed/gi)) {
            window.parent.postMessage("resize", "*");
        }
    </script>


</head>

<body translate="no" >
<a class="other-version-link" href="https://codepen.io/MarkBoots/full/LYyeGzo" target="_blank">
    <i class="far fa-caret-square-right"></i> v6-beta Cheatsheet</a>
<header>
    <h1>FontAwesome 5 Cheatsheet<span class="version"></span></h1>
    <h2>click & copy</h2>
</header>
<nav>
    <div class="filter-container">
        <div class="import-fa">
            <span class="importhtml" title="copy HTML FA link">link <i class="fab fa-html5"></i></span>
            <span class="importcss" title="copy CSS FA @import">@import <i class="fab fa-css3-alt"></i></span>
        </div>
    </div>
</nav>
<main>
    <div class="icon-container"></div>
</main>
<div class="clipboard">
    <h3>Copied to clipboard</h3>
    <code></code>
</div>
<div class="tempSVG"></div>
<script src="https://cpwebassets.codepen.io/assets/common/stopExecutionOnTimeout-1b93190375e9ccc259df3a57c1abc0e64599724ae30d7ea4c6877eb615f89387.js"></script>


<script id="rendered-js" >
    //icons: https://raw.githubusercontent.com/FortAwesome/Font-Awesome/master/metadata/icons.json;
    //categories: https://github.com/FortAwesome/Font-Awesome/blob/master/metadata/categories.yml;
    let fa_version = "v5.15.3";
    let fa_source_url =
        "https://mark-boots.nl/codepenfiles/fontawesome/data/fa_icons.json";
    let h1versionEl = document.querySelector("h1 .version");
    let filterContainerEl = document.querySelector(".filter-container");
    let iconContainerEl = document.querySelector(".icon-container");
    let clipboard = document.querySelector(".clipboard");
    let clipboard_code = document.querySelector(".clipboard code");
    let copyHTMLbtn = document.querySelector(".importhtml");
    let copyCSSbtn = document.querySelector(".importcss");
    let tempSVG = document.querySelector(".tempSVG");

    let faIcons, faCategories, faStyles;
    let filterstylesEl, filterCategoriesEl, filterSearchEl;
    let filterOptions = {
        style: "",
        category: "",
        search: "" };


    h1versionEl.textContent = `(${fa_version})`;
    loadFAData();

    copyCSSbtn.addEventListener("click", () => {
        let clip = `@import url('https://use.fontawesome.com/releases/${fa_version}/css/all.css')`;
        copyToClipboard(clip);
    });
    copyHTMLbtn.addEventListener("click", () => {
        let clip = `<link rel="stylesheet" href="https://use.fontawesome.com/releases/${fa_version}/css/all.css"></link>`;
        copyToClipboard(clip);
    });

    async function loadFAData() {
        const response = await fetch(fa_source_url);
        const data = await response.json();
        faIcons = data.icons;
        faCategories = data.categories;
        faStyles = data.styles;
        createFilters();
        displayIcons(filterOptions);
    }

    function createFilters() {
        let filterstyles = createFilterStyles();
        let filterCategories = createFilterCategories();
        let filterSearch = createFilterSearch();

        filterContainerEl.prepend(filterstyles, filterCategories, filterSearch);
    }

    function createFilterSearch() {
        let wrap = document.createElement("div");
        wrap.classList.add("filter-search");

        let label = document.createElement("label");
        let field = document.createElement("input");

        field.style = "text";
        field.id = "filter-search";
        field.addEventListener("keyup", e => {
            filterOptions.search = e.target.value;
            displayIcons(filterOptions);
            if (filterOptions.search.length > 0) {
                label.classList.add("active");
            } else {
                label.classList.remove("active");
            }
        });

        label.setAttribute("for", "filter-search");
        label.textContent = "Search";
        label.addEventListener("click", () => {
            field.value = "";
            filterOptions.search = field.value;
            displayIcons(filterOptions);
            label.classList.remove("active");
        });

        wrap.append(label, field);
        return wrap;
    }

    function createFilterStyles() {
        let wrap = document.createElement("div");
        wrap.classList.add("filter-style");

        let label = document.createElement("label");
        let select = document.createElement("select");

        label.setAttribute("for", "style-select");
        label.textContent = "Style";
        label.addEventListener("click", () => {
            select.value = "";
            filterOptions.style = select.value;
            displayIcons(filterOptions);
            label.classList.remove("active");
        });

        select.id = "style-select";
        select.addEventListener("change", e => {
            filterOptions.style = e.target.value;
            displayIcons(filterOptions);
            if (filterOptions.style.length > 0) {
                label.classList.add("active");
            } else {
                label.classList.remove("active");
            }
        });

        let option = document.createElement("option");
        option.value = "";
        option.textContent = "---";
        select.append(option);

        for (style in faStyles) {
            let option = document.createElement("option");
            option.value = style;
            option.textContent = faStyles[style].label;
            select.append(option);
        }

        wrap.append(label, select);
        return wrap;
    }

    function createFilterCategories() {
        let wrap = document.createElement("div");
        wrap.classList.add("filter-category");

        let label = document.createElement("label");
        let select = document.createElement("select");

        label.setAttribute("for", "category-select");
        label.textContent = "Category";
        label.addEventListener("click", () => {
            select.value = "";
            filterOptions.category = select.value;
            displayIcons(filterOptions);
            label.classList.remove("active");
        });

        select.id = "category-select";
        select.addEventListener("change", e => {
            filterOptions.category = e.target.value;
            displayIcons(filterOptions);
            if (filterOptions.category.length > 0) {
                label.classList.add("active");
            } else {
                label.classList.remove("active");
            }
        });

        let option = document.createElement("option");
        option.value = "";
        option.textContent = "---";
        select.append(option);

        faCategories.forEach(category => {
            let option = document.createElement("option");
            option.value = category.name;
            option.textContent = category.label;
            select.append(option);
        });
        wrap.append(label, select);

        return wrap;
    }

    function displayIcons(options) {
        iconContainerEl.innerHTML = "";
        let filteredIcons = filterIcons(options);
        filteredIcons.forEach(filteredIcon => {
            let icon = createIcon(filteredIcon);
            iconContainerEl.append(icon);
        });
        firstIcon = document.querySelector("icon-container");
    }

    function createIcon(iconDetails) {
        let iconWrapperEl = document.createElement("div");
        iconWrapperEl.classList.add("icon-wrapper");

        //name
        let iconName = document.createElement("div");
        iconName.classList.add("icon-name");
        iconName.textContent = iconDetails.name;
        iconName.title = "Copy HTML";
        iconName.addEventListener("click", () => {
            copyHtml(iconDetails);
        });

        //unicode;
        let iconUnicode = document.createElement("div");
        iconUnicode.classList.add("icon-unicode");
        iconUnicode.textContent = iconDetails.unicode;
        iconUnicode.addEventListener("click", () => {
            copyUnicode(iconDetails);
        });
        iconUnicode.title = "Copy CSS";

        //icon
        let faIconWrapper = document.createElement("div");
        faIconWrapper.classList.add("fa-icon-wrapper");

        let faIcon = document.createElement("i");
        faIcon.classList.add(`fa${iconDetails.style[0]}`, `fa-${iconDetails.name}`);
        faIconWrapper.append(faIcon);

        faIcon.addEventListener("click", () => {
            downloadSVG(iconDetails);
        });

        iconWrapperEl.append(faIconWrapper, iconName, iconUnicode);
        return iconWrapperEl;
    }

    function downloadSVG(icon) {
        console.log(icon);
        //createSVG
        tempSVG.innerHTML = "";
        let svg = new DOMParser().parseFromString(icon.svg.raw, "application/xml");
        tempSVG.append(tempSVG.ownerDocument.importNode(svg.documentElement, true));
        let name = `fa${icon.style[0]}_fa-${icon.name}`;
        var dl = document.createElement("a");
        document.body.appendChild(dl); // This line makes it work in Firefox.
        dl.setAttribute("href", svgDataURL(svg));
        dl.setAttribute("download", `${name}.svg`);
        dl.click();
        document.body.removeChild(dl);
    }

    function svgDataURL(svg) {
        var svgAsXML = new XMLSerializer().serializeToString(svg);
        return "data:image/svg+xml," + encodeURIComponent(svgAsXML);
    }

    function copyUnicode(iconDetails) {
        let style = faStyles[iconDetails.style];
        let clip = `content: '\\${iconDetails.unicode}';\nfont-family: '${style["font-family"]}';\nfont-weight: ${style["font-weight"]};`;
        copyToClipboard(clip);
    }
    function copyHtml(iconDetails) {
        let clip = `<i class="fa${iconDetails.style[0]} fa-${iconDetails.name}"></i>`;
        copyToClipboard(clip);
    }

    function copyToClipboard(clip) {
        let temp = document.createElement("textarea");
        document.body.appendChild(temp);
        temp.value = clip;
        temp.select();
        document.execCommand("copy");
        document.body.removeChild(temp);

        clipboard_code.innerText = clip;
        clipboard.classList.add("active");

        setTimeout(function () {
            clipboard.classList.remove("active");
        }, 2000);
    }

    function filterIcons({ style, category, search }) {
        icons = faIcons;

        let filtered = [];
        //filter style
        if (style.length > 0) {
            icons.forEach(icon => {
                if (icon.style == style) filtered.push(icon);
            });
            icons = filtered;
            filtered = [];
        }
        //filter category
        if (category.length > 0) {
            icons.forEach(icon => {
                if (icon.categories.includes(category)) filtered.push(icon);
            });
            icons = filtered;
            filtered = [];
        }
        //filter search
        if (search.length > 0) {
            let re = new RegExp(search.trim(), "gi");
            icons.forEach(icon => {
                let found = false;
                if (re.test(icon.name) || re.test(icon.label)) {
                    found = icon;
                } else {
                    icon.search.forEach(item => {
                        if (re.test(item)) {
                            found = icon;
                        }
                    });
                }
                if (found) filtered.push(found);
            });
            icons = filtered;
            filtered = [];
        }

        return icons;
    }
    //# sourceURL=pen.js
</script>



</body>

</html>
 
