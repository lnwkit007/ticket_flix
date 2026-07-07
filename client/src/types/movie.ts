export interface moviesApiResponse {
    status: string;
    message: string;
    data: moviesPagination;
}

export interface moviesPagination {
    current_page: number;
    data: movie[];
    first_page_url: string;
    from: number;
    last_page: number;
    last_page_url: string;
    links: [
        {
            url: string | null;
            label: string;
            page: number | null;
            active: boolean;
        }
    ];
    next_page_url: string | null;
    path: string;
    per_page: number;
    prev_page_url: string | null;
    to: number;
    total: number;
}

export interface movie {
    id: number;
    movie_title: string;
    movie_synopsis: string;
    movie_poster: string;
    deleted_at: string | null;
    tags: [
        {
            id: number;
            movie_tag_name: string;
            deleted_at: string | null;
        }
    ];
    showtimes: [
        {
            id: number;
            start_time: string;
            base_price: string;
            movie_id: number;
            theater_id: number;
            deleted_at: string | null;
            theater: {
                id: number;
                theater_name: string;
                seats_maximum: number;
                theater_type_id: number;
                deleted_at: string | null;
                theater_type: {
                    id: number;
                    theater_type_name: string;
                    deleted_at: string | null;
                }
            }
        }
    ]
}