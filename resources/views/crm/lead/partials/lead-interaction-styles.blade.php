    .comment-history-summary {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 12px;
        margin-bottom: 14px;
        border: 1px solid #dbeafe;
        border-radius: 9px;
        background: #eff6ff;
    }
    .comment-timeline { position: relative; padding-left: 26px; }
    .comment-timeline::before {
        content: '';
        position: absolute;
        top: 7px;
        bottom: 7px;
        left: 8px;
        width: 2px;
        background: #dbe4ef;
    }
    .comment-timeline-item { position: relative; padding-bottom: 14px; }
    .comment-timeline-item:last-child { padding-bottom: 0; }
    .comment-timeline-dot {
        position: absolute;
        top: 16px;
        left: -26px;
        width: 18px;
        height: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 3px solid #eff6ff;
        border-radius: 50%;
        background: #2563eb;
        box-shadow: 0 0 0 1px #93c5fd;
    }
    .comment-history-card {
        overflow: hidden;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        background: #fff;
        box-shadow: 0 2px 7px rgba(15, 23, 42, .05);
    }
    .comment-history-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
        padding: 9px 12px;
        border-bottom: 1px solid #f1f5f9;
        background: #f8fafc;
    }
    .comment-history-content { padding: 11px 12px; }
    .comment-message-box {
        padding: 9px 10px;
        border-left: 3px solid #60a5fa;
        border-radius: 0 6px 6px 0;
        background: #f8fafc;
        color: #334155;
        font-size: 12px;
        line-height: 1.55;
        white-space: pre-wrap;
        word-break: break-word;
    }


