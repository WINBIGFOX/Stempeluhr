export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at?: string;
}

export interface Date {
    diff: string;
    formatted: string;
    date: string;
    day: string;
}

export interface WeekdayObject {
    plan: number;
    fallbackPlan: number;
    date: Date;
    workTime: number;
    breakTime: number;
    noWorkTime: number;
    timestamps: unknown[];
}

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
    auth: {
        user: User;
    };
};
