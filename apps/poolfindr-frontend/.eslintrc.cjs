module.exports = {
  root: true,
  parser: "@babel/eslint-parser",
  parserOptions: {
    sourceType: "module",
  },
  extends: [
    "@nuxtjs/eslint-config-typescript",
    "plugin:vue/vue3-essential",
    "eslint:recommended",
    "plugin:import/errors",
    "plugin:import/warnings",
  ],
};
