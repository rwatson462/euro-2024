
export function formatDate(date: Date | string): string {
    if (typeof date === 'string') {
        date = new Date(date)
    }

    // example: 01/01/2024, 20:00:00
    return new Date(date).toLocaleString("en-GB", {dateStyle: 'medium', timeStyle: 'short'})
}
