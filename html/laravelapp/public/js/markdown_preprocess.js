/**
 * langから始まるクラス文字列を変換する関数
 *
 * language-PHp -> lang-php
 * language-js -> lang-js
 * language-mermaid -> mermaid
 */
const convertLanguageClass = (str) => {
    // language-mermaid -> mermaid
    if ("language-mermaid" === str) {
        console.log(str + "を変換します");
        return "mermaid";
    }
    // language-PHp -> lang-php
    return "lang-" + str.trim().split("-")[1].toLowerCase();
};

/**
 * langから始まるクラスを処理する
 */
const codes = document.querySelectorAll("[class^='lang']"); // langから始まるクラス
for (const code of codes) {
    const newLangClass = convertLanguageClass(code.classList[0]);
    const pre = code.parentNode;
    pre.textContent = code.textContent; // codeタグは消える
    // pre.classList.add('prettyprint', newLangClass, 'linenums');
    pre.classList.add("mermaid");
}
