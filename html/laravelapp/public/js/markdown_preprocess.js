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
