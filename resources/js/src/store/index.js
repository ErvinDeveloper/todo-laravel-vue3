import { createStore } from "vuex";
import task from "@/src/store/modules/task";
const store = createStore({
    modules() {
        task
    }
})

export default store;
