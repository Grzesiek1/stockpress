import i18n from 'i18next';
import {initReactI18next} from 'react-i18next';
import TRANSLATIONS_PL from './translations/pl.json';

i18n.use(initReactI18next).init({
    supportedLngs: ['pl'],
    resources: {
        pl: {
            translation: TRANSLATIONS_PL
        }
    },
    lng: 'pl',
});

export const { t } = i18n;
