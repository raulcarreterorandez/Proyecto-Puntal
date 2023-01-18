export declare enum ADTStyleOptions {
    DT = "dt",
    BS3 = "bs3",
    BS4 = "bs4",
    BS5 = "bs5"
}
export declare const ADT_SUPPORTED_STYLES: {
    style: ADTStyleOptions;
    packageJson: {
        version: string;
        name: string;
        isDev: boolean;
    }[];
    angularJson: {
        path: string;
        target: string;
        fancyName: string;
    }[];
}[];
