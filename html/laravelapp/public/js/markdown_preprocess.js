const p = console.log;

/**
pre {
  margin: 1em 0;
  padding: 1em;
  border-radius: 5px;
  background: #25292f;
  color: #fff;
  overflow-x: auto;
  -webkit-overflow-scrolling: touch;
}
*/
const addStyleForPre = (pre) => {
    const a = {
        margin: "1em 0",
        padding: "1em",
        "border-radius": "5px",
        color: "#fff",
        "overflow-x": "auto",
        "-webkit-overflow-scrolling": "touch",
        "box-shadow": "2px 2px 4px gray",
    };
    const keys = Object.keys(a);
    keys.forEach((key) => {
        const value = a[key];
        // documents.getElementById("id").style.fontSize = "20px" ;
        pre.style[key] = value;
    });
};

/**
 * langから始まるクラスを処理する
 *
 * language-PHp -> lang-php
 * language-js -> lang-js
 * language-mermaid -> mermaid
 */
const codes = document.querySelectorAll("[class^='lang']"); // langから始まるクラス
for (const code of codes) {
    // language-mermaid, language-pHp
    const oldLangClass = code.classList[0];

    // codeタグをpreタグに変換する
    const pre = code.parentNode;
    addStyleForPre(pre);
    pre.textContent = code.textContent; // codeタグは消える

    // cssを処理する
    if ("language-mermaid" === oldLangClass) {
        /* mermaid js */
        pre.classList.add("mermaid");
    } else {
        /* prettyprint */
        // language-PHp -> lang-php
        const lang = "lang-" + oldLangClass.trim().split("-")[1].toLowerCase();
        pre.classList.add("prettyprint", lang, "linenums");
    }
}
