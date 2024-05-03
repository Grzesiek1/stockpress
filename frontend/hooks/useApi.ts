import getConfig from 'next/config';
import axios from "axios";
import fileDownload from 'js-file-download';

const useApi = () => {
    const {publicRuntimeConfig} = getConfig();
    const apiUrl = publicRuntimeConfig.apiUrl;

    const get = async (endpoint: string, page: number) => {
        return await axios.get(apiUrl + endpoint, {params: {page}});
    }

    const post = async (endpoint: string, params: FormData) => {
        let response = await axios.post(apiUrl + endpoint, params);

        return response.data
    }

    const remove = async (endpoint: string, id: number) => {
        await axios.delete(apiUrl + endpoint + '/' + id);
    }

    const download = async (url: string, fileName: string) => {
        let response = await axios.get(url, {responseType: 'blob'});
        fileDownload(response.data, fileName);
    }

    return {
        get,
        post,
        remove,
        download
    }
};

export default useApi;