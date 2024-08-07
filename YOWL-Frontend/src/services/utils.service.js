import { baseService } from "./base.service";

export function utilsService()
{
    const serve = baseService();

    async function getVal(url)
    {
        return (await serve.get(url));
    }

    return {
        getVal
    }
}