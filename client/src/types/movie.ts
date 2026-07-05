export interface movie {
    id: number;
    movie_title: string;
    movie_synopsis: string;
    movie_poster: string | null;
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

export interface moviesApiResponse {
    status: string;
    message: string;
    data: movie[];
}