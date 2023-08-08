const errorMessages = {
  nicknameMinLength: "Введите не менее 5 символов",
  invalidNickname: "Поле может содержать символы a-z, 0-9 и подчеркивания",
  email: "Введите валидный email",
  phone: "Введите номер телефона",
};

/* Отправка форм */
function formSubmit(validate) {
  const forms = document.forms;
  if (forms.length) {
    for (const form of forms) {
      if (form.contacts?.dataset.type === "whatsapp") {
        setInputMask(form.contacts);
      }

      form.addEventListener("submit", function (e) {
        const form = e.target;
        formSubmitAction(form, e);
      });
    }
  }

  const ajaxSend = async (url, formData) => {
    const response = await fetch(url, {
      method: "POST",
      credentials: "same-origin",
      body: formData,
    });
    if (!response.ok) {
      throw new Error(
        `Ошибка по адресу ${url}, статус ошибки ${response.status}`
      );
    }
    return await response.text();
  };

  async function formSubmitAction(form, e) {
    const error = validate ? formValidate.getErrors(form) : 0;
    if (error === 0) {
      e.preventDefault();
      if (form.classList.contains("form-block__form")) {
        let data = new FormData(form);
        const submitBtn = form.querySelector('[type="submit"]');

        submitBtn.disabled = true;

        data.append("action", "contacts_form");
        data.append("nonce", incon.nonce);

        ajaxSend(incon.ajax_url, data)
          .then(() => {
            document.getElementById("mail-success-btn").click();
          })
          .catch((err) => {
            console.log(err);
            document.getElementById("mail-error-btn").click();
          })
          .finally(() => {
            setTimeout(function () {
              document.querySelector(".popup-show .popup__close").click();
            }, 4000);
            formClean(form);
            submitBtn.disabled = false;
          });
      }
    } else {
      e.preventDefault();
    }
  }
}

const setInputMask = (input) => {
  Inputmask({ mask: "+7(999) 999-99-99" }).mask(input);
};

// Работа с полями формы. Добавление классов, работа с placeholder
function formFieldsInit() {
  document.body.addEventListener("focusin", function (e) {
    const targetElement = e.target;
    if (
      targetElement.tagName === "INPUT" ||
      targetElement.tagName === "TEXTAREA"
    ) {
      targetElement.classList.add("_form-focus");
      targetElement.parentElement.classList.add("_form-focus");

      formValidate.removeError(targetElement);
    }
  });
  document.body.addEventListener("focusout", function (e) {
    const targetElement = e.target;
    if (
      targetElement.tagName === "INPUT" ||
      targetElement.tagName === "TEXTAREA"
    ) {
      targetElement.classList.remove("_form-focus");
      targetElement.parentElement.classList.remove("_form-focus");

      // Моментальная валидация
      if (targetElement.hasAttribute("data-validate")) {
        formValidate.validateInput(targetElement);
      }
    }
  });
}

const formClean = (form) => {
  form.reset();
  setTimeout(() => {
    let inputs = form.querySelectorAll("input,textarea");
    for (let index = 0; index < inputs.length; index++) {
      const el = inputs[index];
      el.parentElement.classList.remove("_form-focus");
      el.classList.remove("_form-focus");
      formValidate.removeError(el);
    }
    let checkboxes = form.querySelectorAll(".checkbox__input");
    if (checkboxes.length > 0) {
      for (let index = 0; index < checkboxes.length; index++) {
        const checkbox = checkboxes[index];
        checkbox.checked = false;
      }
    }
  }, 0);
};

// Валидация форм
let formValidate = {
  getErrors(form) {
    let error = 0;
    let formRequiredItems = form.querySelectorAll("*[data-required]");
    if (formRequiredItems.length) {
      formRequiredItems.forEach((formRequiredItem) => {
        if (
          (formRequiredItem.offsetParent !== null ||
            formRequiredItem.tagName === "SELECT") &&
          !formRequiredItem.disabled
        ) {
          error += this.validateInput(formRequiredItem);
        }
      });
    }
    return error;
  },
  validateInput(formRequiredItem) {
    let error = 0;

    if (
      formRequiredItem.dataset.required === "email" ||
      formRequiredItem.dataset.type === "email"
    ) {
      formRequiredItem.value = formRequiredItem.value.replace(" ", "");
      if (this.emailTest(formRequiredItem)) {
        formRequiredItem.dataset.error = errorMessages.email;

        this.addError(formRequiredItem);
        error++;
      } else {
        this.removeError(formRequiredItem);
      }
    } else if (formRequiredItem.dataset.type === "telegram") {
      formRequiredItem.value = formRequiredItem.value.replace(" ", "");

      if (this.nicknameTest(formRequiredItem)) {
        formRequiredItem.dataset.error =
          formRequiredItem.value.length > 4
            ? errorMessages.invalidNickname
            : errorMessages.nicknameMinLength;
        this.addError(formRequiredItem);
        error++;
      } else {
        this.removeError(formRequiredItem);
      }
    } else if (formRequiredItem.dataset.type === "whatsapp") {
      const number = formRequiredItem.value.replace(/\D/g, "");

      if (number.length < 11) {
        formRequiredItem.dataset.error = errorMessages.phone;

        this.addError(formRequiredItem);
        error++;
      } else {
        this.removeError(formRequiredItem);
      }
    } else if (
      formRequiredItem.type === "checkbox" &&
      !formRequiredItem.checked
    ) {
      this.addError(formRequiredItem);
      error++;
    } else {
      if (!formRequiredItem.value) {
        this.addError(formRequiredItem);
        error++;
      } else {
        this.removeError(formRequiredItem);
      }
    }
    return error;
  },

  addError(formRequiredItem) {
    formRequiredItem.classList.add("_form-error");
    formRequiredItem.parentElement.classList.add("_form-error");
    let inputError =
      formRequiredItem.parentElement.querySelector(".form__error");
    if (inputError) formRequiredItem.parentElement.removeChild(inputError);
    if (formRequiredItem.dataset.error) {
      formRequiredItem.parentElement.insertAdjacentHTML(
        "beforeend",
        `<div class="form__error">${formRequiredItem.dataset.error}</div>`
      );
    }
  },
  removeError(formRequiredItem) {
    formRequiredItem.classList.remove("_form-error");
    formRequiredItem.parentElement.classList.remove("_form-error");
    if (formRequiredItem.parentElement.querySelector(".form__error")) {
      formRequiredItem.parentElement.removeChild(
        formRequiredItem.parentElement.querySelector(".form__error")
      );
    }
  },
  emailTest(formRequiredItem) {
    return !/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,8})+$/.test(
      formRequiredItem.value
    );
  },
  nicknameTest(formRequiredItem) {
    return !/^[a-zA-Z0-9_]{5,}$/.test(formRequiredItem.value);
  },
  phoneNumberTest(formRequiredItem) {
    return !/^[0-9+]{5,}$/.test(formRequiredItem.value);
  },
};

formFieldsInit();
formSubmit(true);
