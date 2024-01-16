export type TImage = {
  src: string;
  alt: string;
  errorImageSize?: string;
  errorTextStyle?: string;
  spinnerSize?: string;
};

export type TUserAdmission = {
  first_name?: string;
  last_name?: string;
  email: string;
  password?: string;
  password_confirmation?: string;
};
