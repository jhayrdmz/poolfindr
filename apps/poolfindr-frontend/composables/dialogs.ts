/**
 * imports
 */
import { ref } from "vue";

const activeDialog = ref<string>("");
const dialogData = ref<any>({});

export function useDialog() {
  const fnSetActiveDialog = (dialog: string, data?: any) => {
    activeDialog.value = dialog;
    dialogData.value = data;
  };

  return {
    activeDialog,
    dialogData,
    fnSetActiveDialog,
  };
}
