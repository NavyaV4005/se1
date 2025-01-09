#include <stdio.h>
#define MAX_FRAMES 3

int findFarthest(int pages[], int current, int frame[], int n) {
    int farthest = -1, index = -1;
    for (int i = 0; i < MAX_FRAMES; i++) {
        int j;
        for (j = current + 1; j < n; j++) {
            if (frame[i] == pages[j]) break;
        }
        if (j == n) return i;
        if (j > farthest) { farthest = j; index = i; }
    }
    return index;
}

int main() {
    int pages[] = {7, 0, 1, 2, 0, 3, 0, 4, 2, 3, 0, 3, 2, 1, 2, 0, 1, 7, 0, 1};
    int n = sizeof(pages) / sizeof(pages[0]);
    int frame[MAX_FRAMES] = {-1, -1, -1};
    int pageFaults = 0;

    for (int i = 0; i < n; i++) {
        int page = pages[i], found = 0;
        for (int j = 0; j < MAX_FRAMES; j++) {
            if (frame[j] == page) { found = 1; break; }
        }
        if (!found) {
            pageFaults++;
            int replaceIndex = -1;
            for (int j = 0; j < MAX_FRAMES; j++) {
                if (frame[j] == -1) { replaceIndex = j; break; }
            }
            if (replaceIndex == -1) replaceIndex = findFarthest(pages, i, frame, n);
            frame[replaceIndex] = page;
        }
    }

    printf("Total page faults: %d\n", pageFaults);
    return 0;
}
