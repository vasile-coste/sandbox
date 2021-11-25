<template>
  <div class="w-full flex flex-col max-height">
    <div class="w-full bg-gray-700 text-white p-2 flex justify-between">
      <select
        class="bg-gray-700 text-white border-solid border rounded-md border-gray-500"
        v-model="language"
      >
        <option value="php">PHP</option>
        <option value="js">JavaScript</option>
      </select>
      <div class="">
        <button
          class="border-solid border rounded-md border-gray-500 px-3 py-2 hover:bg-gray-800"
          @click="handleRun"
        >
          Run
        </button>
        <button
          class="border-solid border rounded-md border-gray-500 px-3 py-2 hover:bg-gray-800"
          @click="handleSave"
        >
          Save
        </button>
      </div>
    </div>
    <div class="flex flex-col bg-gray-700 text-white">
      <div
        v-for="(res, index) in result"
        :key="res.test"
        class="flex justify-between mb-2 mx-2 p-1 border rounded-md border-gray-500 text-sm"
      >
        <div class="flex">
          <div class="mr-1">
            <CheckCircle
              v-if="res.pass"
              class="text-green-500"
            />
            <XCircle
              v-else
              class="text-red-500"
            />
          </div>
          <div>{{res.test}}</div>
        </div>
        <div
          class="ml-1 cursor-pointer text-gray-400 focus:text-white hover:text-white"
          @click="handleClose(index)"
        >
          <Close />
        </div>
      </div>
    </div>
    <prism-editor
      v-if="code !== null"
      class="editor-settings"
      v-model="code"
      :highlight="highlighter"
      line-numbers
      :readonly="readonly"
    ></prism-editor>
    <div
      v-else
      class="flex justify-center p-4"
    >
      <div class="lds-dual-ring"></div>
    </div>
  </div>
</template>

<script>
import CheckCircle from "~/components/icons/CheckCircle.vue";
import XCircle from "~/components/icons/XCircle.vue";
import Close from "~/components/icons/Close.vue";

// import Prism Editor
import { PrismEditor } from "vue-prism-editor";
import "vue-prism-editor/dist/prismeditor.min.css"; // import the styles somewhere

// import highlighting library (you can use any library you want just return html string)
import { highlight, languages } from "prismjs/components/prism-core";
import "prismjs/components/prism-clike";
import "prismjs/components/prism-javascript";
import "prismjs/themes/prism-tomorrow.css"; // import syntax highlighting styles

export default {
  name: "CodeEditor",
  components: {
    CheckCircle,
    XCircle,
    Close,
    PrismEditor,
  },

  props: {
    task_id: {
      required: true,
      description: "Task id",
    },
  },

  data() {
    return {
      readonly: true,
      solution_id: null,
      language: "php",
      langOld: "php",
      code: null,
      solutions: [],
      result: [],
      codeDefault: "function solution(...\n",
    };
  },

  computed: {},

  watch: {
    language: {
      handler(newVal, oldVal) {
        this.handleLanguageChange(newVal, oldVal);
      },
      deep: true,
    },
  },

  mounted() {
    this.getSolutions();
  },

  methods: {
    highlighter(solution) {
      return highlight(solution, languages.js);
    },
    handleLanguageChange(newLang, oldLang) {
      // do nothing if new language is the same as old one from history
      if (newLang === this.langOld) {
        return false;
      }
      this.result = [];
      const newSol = this.solutions.find((sol) => sol.language === newLang);
      const oldSol = this.solutions.find((sol) => sol.language === oldLang);
      // check if user has modified the code and not saved it
      if (
        oldSol &&
        oldSol.solution.replace(/\s/g, "") != this.code.replace(/\s/g, "") &&
        this.code != null &&
        this.code.replace(/\s/g, "") != this.codeDefault.replace(/\s/g, "")
      ) {
        if (
          !confirm(
            "You have unsaved changes, are you sure you want to change the language?"
          )
        ) {
          // undo change language
          this.language = oldLang;
          return false;
        }
      }
      // change language
      if (newSol) {
        this.code = newSol.solution;
        this.solution_id = newSol.id;
      } else {
        this.code = this.codeDefault;
        this.solution_id = null;
      }
      this.langOld = newLang;
    },
    async handleSave() {
      let obj = {};
      if (this.solution_id) {
        obj = {
          action: "update",
          id: this.solution_id,
          solution: this.code,
        };
      } else {
        obj = {
          action: "save",
          language: this.language,
          task_id: this.task_id,
          solution: this.code,
        };
      }
      try {
        const res = await this.$store.dispatch("saveSolution", obj);
        if (!this.solution_id) {
          this.solution_id = res.data.data.id;
          this.solutions.push(res.data.data);
        } else {
          this.solutions.map((sol) => {
            if (sol.id === obj.id) {
              sol.solution = this.code;
            }
            return sol;
          });
        }
        this.$notify({
          title: "",
          type: "success",
          text: res.data.message,
        });
      } catch (error) {
        error.response.data.messages.forEach((msg) => {
          this.$notify({
            title: "",
            type: error.response.data.type,
            text: msg,
          });
        });
      }
    },
    async getSolutions() {
      this.solutions = [];
      try {
        const res = await this.$store.dispatch("getSolutions", this.task_id);
        this.solutions = res.data.data;
        if (this.solutions.length) {
          let sol = this.solutions.find(
            (sol) => sol.language === this.language
          );
          sol = sol ?? this.solutions[0];
          this.code = sol.solution;
          this.language = sol.language;
          this.solution_id = sol.id;
        } else {
          this.code = this.codeDefault;
        }
        this.readonly = false;
      } catch (error) {
        error.response.data.messages.forEach((msg) => {
          this.$notify({
            title: "",
            type: error.response.data.type,
            text: msg,
          });
        });
        this.readonly = false;
      }
    },
    async handleRun() {
      this.result = [];
      try {
        const res = await this.$store.dispatch("runCode", {
          task_id: this.task_id,
          language: this.language,
          solution: this.code,
        });

        if (res.data.data.length == 0) {
          this.result = [
            {
              test: "No tests found to run.",
              pass: false,
            },
          ];
          return;
        }

        if (this.language === "js") {
          if (res.data.data[0] && res.data.data[0].code) {
            this.runJsCode(res.data.data);
          } else {
            this.result = res.data.data;
          }
        } else {
          this.result = res.data.data;
        }
      } catch (error) {
        if (error.response && error.response.data) {
          if (error.response.data.message) {
            // show errors
            this.result = [
              {
                test: error.response.data.message,
                pass: false,
              },
            ];
          } else {
            error.response.data.messages.forEach((msg) => {
              this.$notify({
                title: "",
                type: error.response.data.type,
                text: msg,
              });
            });
          }
        } else {
          this.$notify({
            title: "",
            type: "error",
            text: "Something went wrong, please try again later.",
          });
        }
      }
    },
    runJsCode(sets) {
      sets.forEach((data) => {
        try {
          const fnTest = new Function(data.code);
          const result = fnTest();
          this.result.push({
            test: `Run solution with (${data.params}). Got ${JSON.stringify(
              result
            )}, expected ${data.result}.`,
            pass: data.result == (Array.isArray(result) ? JSON.stringify(result): result),
          });
        } catch (error) {
          this.result = [
            {
              test: error.message,
              pass: false,
            },
          ];
        }
      });
    },
    handleClose(index) {
      this.result.splice(index, 1);
    },
  },
};
</script>

<style>
.editor-menu {
  background: #111111;
  color: rgb(230, 230, 230);
}
.editor-settings {
  background: #2d2d2d;
  color: #ccc;
  font-family: Consolas, Courier, monospace;
  font-size: 14px;
  line-height: 1.5;
  padding: 5px;
  min-height: 30vh;
  height: 100%;
}

.prism-editor__textarea:focus {
  outline: none;
}
</style>